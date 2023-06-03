import { getHatInventory } from '@/api'
import { createAsyncThunk, createSlice } from '@reduxjs/toolkit'
import { RootState } from './store'

interface HatInventoryState {
  status: 'unknown' | 'loading' | 'ok' | 'error'
  currentPage: number | null
  pages: number | null
  total: number | null
  items:
    | {
        count: number
        product: {
          id: number
          name: string
          description: string
          preview_img_url: string | null
        }
      }[]
    | null
}

const initialState: HatInventoryState = {
  status: 'unknown',
  currentPage: null,
  pages: null,
  items: null,
  total: null,
}

export const hatInventorySlice = createSlice({
  name: 'inventory/hat',
  initialState,
  reducers: {},
  extraReducers($) {
    $.addCase(loadNextPage.pending, (state) => {
      state.status = 'loading'
    })
    $.addCase(loadNextPage.rejected, (state) => {
      state.status = 'error'
    })
    $.addCase(loadNextPage.fulfilled, (state, { payload: res }) => {
      if (res.code == 'error') {
        state.status = 'error'
        return
      }
      state.status = 'ok'
      state.currentPage = res.data.meta.current_page
      state.pages = res.data.meta.last_page
      state.items = res.data.data
      state.total = res.data.meta.total
    })
  },
})

interface LoadNextPageArgs {
  perPage?: number
  page?: number
}
export const loadNextPage = createAsyncThunk(
  'inventory/hat/loadNextPage',
  async (args: LoadNextPageArgs = {}, api) => {
    const state = api.getState() as RootState

    const currentPage = state.hatInventory.currentPage
    const next = currentPage ? currentPage + 1 : currentPage

    const res = await getHatInventory(
      args.perPage,
      Math.min(args.page ?? next ?? 1, state.hatInventory.pages ?? 1)
    )

    if (res.code === 'ok') {
      return {
        code: 'ok',
        data: {
          ...res.products,
          data: res.products.data.map((json) => ({
            ...json,
            product: {
              ...json.product,
              preview_img_url: json.product.preview_img_url
                ? `${import.meta.env.VITE_BASE_URL}/${
                    json.product.preview_img_url
                  }`
                : null,
            },
          })),
        },
      } as const
    }
    return res
  }
)
