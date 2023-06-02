import _axios, { AxiosError } from 'axios'
const axios = _axios.create({
  baseURL: import.meta.env.VITE_MAIN_SERVER_URL,
})

export const tokens = {
  get accessToken(): string | null {
    return localStorage.getItem('accessToken')
  },
  set accessToken(token: string | null) {
    if (!token) {
      localStorage.removeItem('accessToken')
      return
    }
    localStorage.setItem('accessToken', token)
  },
  get refreshToken(): string | null {
    return localStorage.getItem('refreshToken')
  },
  set refreshToken(token: string | null) {
    if (!token) {
      localStorage.removeItem('refreshToken')
      return
    }
    localStorage.setItem('refreshToken', token)
  },
}
let updateTokenCycle: ReturnType<typeof setTimeout> | undefined
export async function startUpdateTokenCycle() {
  await updateAccessToken()
  updateTokenCycle = setInterval(() => {
    updateAccessToken()
  }, 1000 * 60 * 4)
}
export function stopUpdateTokenCycle() {
  clearInterval(updateTokenCycle)
}

interface Login {
  identifier: string
  password: string
}
type LoginResponse =
  | {
      code: 'ok'
    }
  | {
      code: 'error' | 'UserNotFound' | 'InvalidPassword' | 'AccountDisabled'
    }
export async function login({
  identifier,
  password,
}: Login): Promise<LoginResponse> {
  try {
    const loginRes = await axios.post('/Auth/Tokens', {
      username: identifier,
      password,
    })
    tokens.refreshToken = loginRes.data.refreshToken
    tokens.accessToken = loginRes.data.accessToken
    return { code: 'ok' }
  } catch (e) {
    if (e instanceof AxiosError) {
      if (e.response?.status == 401) {
        return { code: e.response?.data?.cause }
      }
    }
    return { code: 'error' }
  }
}

type AuthResponse =
  | {
      code: 'ok'
      user: {
        id: string
        username: string
        email: string
      }
    }
  | {
      code: 'error' | '403'
    }
export async function auth(): Promise<AuthResponse> {
  try {
    const res = await axios.get('/Auth/GetUser', {
      headers: { Authorization: `Bearer ${tokens.accessToken}` },
    })
    return {
      code: 'ok',
      user: res.data,
    }
  } catch (e) {
    if (e instanceof AxiosError) {
      if (e.response?.status == 403) return { code: '403' }
    }
    return { code: 'error' }
  }
}

export type UpdateAccessTokenResponse =
  | {
      code: 'ok'
    }
  | {
      code: 'error'
    }
export async function updateAccessToken(): Promise<UpdateAccessTokenResponse> {
  if (!tokens.refreshToken) return { code: 'error' }
  try {
    const res = await axios.post('/Auth/ReloadTokens', {
      refreshToken: tokens.refreshToken,
    })
    tokens.accessToken = res.data.accessToken
    tokens.refreshToken = res.data.refreshToken
    return { code: 'ok' }
  } catch (error) {
    return { code: 'error' }
  }
}
