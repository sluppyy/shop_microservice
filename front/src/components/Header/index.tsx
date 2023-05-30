import { Link, useLocation } from 'react-router-dom'
import styles from './header.module.css'
import { useState } from 'react'

const navItems = [
  { path: '/', content: 'Главная' },
  { path: '/products', content: 'Товары' },
]

export default function Header() {
  const [opened, setOpened] = useState(false)

  return (
    <header className="sticky-top">
      <nav className="navbar navbar-expand-md navbar p-2">
        <BrandLogo />
        <button
          className="navbar-toggler"
          type="button"
          onClick={() => {
            setOpened(!opened)
          }}
        >
          <span className="navbar-toggler-icon"></span>
        </button>
        <div
          className={`offcanvas offcanvas-end ${opened ? 'show' : ''}`}
          tabIndex={-1}
        >
          <div className="offcanvas-header">
            <h5 className="offcanvas-title">Меню</h5>
            <button onClick={() => setOpened(false)} className="btn-close" />
          </div>
          <div className="offcanvas-body">
            <ul className="navbar-nav">
              <NavItems />
            </ul>
          </div>
        </div>
      </nav>
    </header>
  )
}

function BrandLogo() {
  return (
    <Link to="/" className="navbar-brand fs-2 d-flex align-items-center">
      <img
        src="/images/hcheart.png"
        alt="logo"
        className={styles['brand-logo']}
      />
      <span className="ms-2">SMShop</span>
    </Link>
  )
}

function NavItems() {
  const currentPath = useLocation().pathname

  return (
    <>
      {navItems.map((item) => (
        <li className="nav-item" key={item.path}>
          <Link
            to={item.path}
            className={`nav-link ${currentPath == item.path ? 'active' : ''}`}
          >
            {item.content}
          </Link>
        </li>
      ))}
    </>
  )
}
