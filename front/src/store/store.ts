import { configureStore } from '@reduxjs/toolkit'
import { TypedUseSelectorHook, useDispatch, useSelector } from 'react-redux'
import { themeSlice } from './theme'
import { hatProductsSlice } from './hatProducts'

export function store() {
  return configureStore({
    reducer: {
      theme: themeSlice.reducer,
      hatProducts: hatProductsSlice.reducer,
    },
  })
}

export type RootState = ReturnType<ReturnType<typeof store>['getState']>
export type AppDispatch = ReturnType<typeof store>['dispatch']
export const useAppDispatch: () => AppDispatch = useDispatch
export const useAppSelector: TypedUseSelectorHook<RootState> = useSelector
