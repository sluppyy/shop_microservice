import { createAsyncThunk, createSlice } from '@reduxjs/toolkit'
import {
  login as apiLogin,
  auth as apiAuth,
  stopUpdateTokenCycle,
  tokens,
} from '@/api'

interface AuthSliceState {
  authStatus: 'unknown' | 'process' | 'ok' | 'error'

  user: {
    id: string
    username: string
    email: string
  } | null
}

const initialState: AuthSliceState = {
  authStatus: 'unknown',
  user: null,
}

export const authSlice = createSlice({
  name: 'auth',
  initialState,
  reducers: {
    logout(state) {
      state.authStatus = 'unknown'
      state.user = null

      stopUpdateTokenCycle()
      tokens.refreshToken = null
      tokens.accessToken = null
    },
  },
  extraReducers($) {
    $.addCase(login.pending, (state) => {
      state.authStatus = 'process'
    })
    $.addCase(login.rejected, (state) => {
      state.authStatus = 'error'
    })
    $.addCase(login.fulfilled, (state, { payload: data }) => {
      if (data.code == 'ok') {
        state.authStatus = 'ok'
        state.user = {
          id: data.user.id,
          username: data.user.username,
          email: data.user.email,
        }
      } else {
        state.authStatus = 'error'
        state.user = null
      }
    })
    $.addCase(auth.fulfilled, (state, { payload: data }) => {
      if (data.code == 'ok') {
        state.authStatus = 'ok'
        state.user = data.user
      }
    })
  },
})

export const { logout } = authSlice.actions

interface Login {
  username: string
  password: string
}

export const login = createAsyncThunk(
  'auth/login',
  async ({ password, username }: Login) => {
    const loginRes = await apiLogin({ identifier: username, password })

    if (loginRes.code != 'ok') return loginRes

    const res = await apiAuth()

    return res
  }
)

export const auth = createAsyncThunk('auth/auth', apiAuth)
