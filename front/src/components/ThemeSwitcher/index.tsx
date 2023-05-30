import { useAppDispatch, useAppSelector } from '@/store'
import { toggle } from '@/store/theme'
import { useEffect } from 'react'

export default function ThemeSwitcher() {
  const theme = useAppSelector((s) => s.theme.theme)
  const dispatch = useAppDispatch()

  const inputProps = {
    checked: theme == 'dark' ? true : undefined,
  }

  useEffect(() => {
    document.body.setAttribute('data-bs-theme', theme)
  }, [theme])

  return (
    <div>
      <i className="d-inline bi-brightness-high-fill" />
      <div className="d-inline form-switch mx-2">
        <input
          className="form-check-input"
          type="checkbox"
          role="switch"
          id="flexSwitchCheckChecked"
          {...inputProps}
          onClick={() => dispatch(toggle())}
        />
      </div>
      <i className="d-inline bi-moon-stars" />
    </div>
  )
}
