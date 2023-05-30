import { createSlice } from '@reduxjs/toolkit'
import { useAppSelector } from './store'

interface ThemeState {
  theme: 'dark' | 'light'
}

function safeTheme(theme?: string | null): ThemeState['theme'] {
  if (!['dark', 'light'].includes(theme as any)) return 'dark'
  return theme as any
}

const initialState: ThemeState = {
  theme: safeTheme(localStorage.getItem('theme.theme')),
}

export const themeSlice = createSlice({
  name: 'theme',
  initialState,
  reducers: {
    toggle(state) {
      state.theme = state.theme === 'dark' ? 'light' : 'dark'
      localStorage.setItem('theme.theme', state.theme)
    },
  },
})

export const { toggle } = themeSlice.actions

export function useThemeState() {
  return useAppSelector((state) => state.theme)
}
