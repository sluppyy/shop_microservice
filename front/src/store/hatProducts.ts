import { HatProduct } from '@/models/HatProduct'
import { createSlice } from '@reduxjs/toolkit'

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
  reducers: {
    load() {},
  },
})

export const { load } = hatProductsSlice.actions
