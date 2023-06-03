import { configureStore } from '@reduxjs/toolkit'
import { TypedUseSelectorHook, useDispatch, useSelector } from 'react-redux'
import { themeSlice } from './theme'
import { hatProductsSlice } from './hatProducts'
import { authSlice } from './auth'
import { balanceSlice } from './balance'

export function store() {
  return configureStore({
    reducer: {
      theme: themeSlice.reducer,
      hatProducts: hatProductsSlice.reducer,
      auth: authSlice.reducer,
      balance: balanceSlice.reducer,
    },
  })
}

export type RootState = ReturnType<ReturnType<typeof store>['getState']>
export type AppDispatch = ReturnType<typeof store>['dispatch']
export const useAppDispatch: () => AppDispatch = useDispatch
export const useAppSelector: TypedUseSelectorHook<RootState> = useSelector
