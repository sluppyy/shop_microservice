import { useAppDispatch, useAppSelector } from '@/store'
import { toggle } from '@/store/theme'
import { useEffect } from 'react'

interface Props {
  className?: string
}

export default function ThemeSwitcher(props: Props) {
  const theme = useAppSelector((s) => s.theme.theme)
  const dispatch = useAppDispatch()

  useEffect(() => {
    const root = document.getElementById('theme-handler')
    root && root.setAttribute('data-bs-theme', theme)
  }, [theme])

  return (
    <div {...props}>
      <i className="d-inline bi-brightness-high-fill" />
      <div className="d-inline form-switch mx-2">
        <input
          className="form-check-input"
          type="checkbox"
          role="switch"
          defaultChecked={theme === 'dark'}
          style={{ cursor: 'pointer' }}
          onChange={() => dispatch(toggle())}
        />
      </div>
      <i className="d-inline bi-moon-stars" />
    </div>
  )
}
