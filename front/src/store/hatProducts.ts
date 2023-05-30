import { findHatProducts } from '@/api'
import { HatProduct } from '@/models/HatProduct'
import { createAsyncThunk, createSlice } from '@reduxjs/toolkit'
import { RootState } from './store'

interface HatProductsState {
  status: 'unknown' | 'loading' | 'ok' | 'error'
  currentPage: number | null
  pages: number | null
  total: number | null
  products: HatProduct[] | null
}

const initialState: HatProductsState = {
  status: 'unknown',
  currentPage: null,
  pages: null,
  products: null,
  total: null,
}

export const hatProductsSlice = createSlice({
  name: 'hatProducts',
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
      state.products = res.data.data
      state.total = res.data.meta.total
    })
  },
})

interface LoadNextPageArgs {
  perPage?: number
  page?: number
}
export const loadNextPage = createAsyncThunk(
  'hatProducts/loadNextPage',
  async (args: LoadNextPageArgs = {}, api) => {
    const state = api.getState() as RootState

    const currentPage = state.hatProducts.currentPage
    const next = currentPage ? currentPage + 1 : currentPage

    const res = await findHatProducts(
      args.perPage,
      Math.min(args.page ?? next ?? 1, state.hatProducts.pages ?? 1)
    )

    if (res.code === 'ok') {
      return {
        code: 'ok',
        data: {
          ...res.products,
          data: res.products.data.map<HatProduct>((json) => ({
            id: json.id,
            name: json.name,
            description: json.description,
            preview_img_url: json.preview_img_url
              ? `${import.meta.env.VITE_BASE_URL}/${json.preview_img_url}`
              : null,
            price: json.price,
            model: json.model,
            custom_model_data: json.custom_model_data,
          })),
        },
      } as const
    }
    return res
  }
)
