import { getBalance } from '@/api'
import { createAsyncThunk, createSlice } from '@reduxjs/toolkit'
import { login } from './auth'

interface BalanceSliceState {
  loadStatus: 'unknown' | 'process' | 'ok' | 'error'

  candies: number | null
}

const initialState: BalanceSliceState = {
  loadStatus: 'unknown',
  candies: null,
}

export const balanceSlice = createSlice({
  name: 'balance',
  initialState,
  reducers: {},
  extraReducers($) {
    $.addCase(loadBalance.pending, (state) => {
      state.loadStatus = 'process'
    })
    $.addCase(loadBalance.rejected, (state) => {
      state.loadStatus = 'error'
      state.candies = null
    })
    $.addCase(loadBalance.fulfilled, (state, { payload: data }) => {
      if (data.code == 'ok') {
        state.loadStatus = 'ok'
        state.candies = data.data.candies ?? 0
        return
      }
      state.loadStatus = 'error'
    })

    $.addCase('auth/logout', (state) => {
      state.loadStatus = 'unknown'
      state.candies = null
    })
  },
})

export const loadBalance = createAsyncThunk('balance/load', getBalance)
