import React from 'react'
import ReactDOM from 'react-dom/client'
import App from './App'
import './index.scss'
import 'bootstrap-icons/font/bootstrap-icons.min.css'
import { BrowserRouter } from 'react-router-dom'
import { Provider } from 'react-redux'
import { store } from './store'

const root = ReactDOM.createRoot(document.getElementById('root') as HTMLElement)

const appStore = store()

if (import.meta.env.PROD) {
  root.render(
    <BrowserRouter>
      <Provider store={appStore}>
        <App />
      </Provider>
    </BrowserRouter>
  )
} else {
  root.render(
    <React.StrictMode>
      <BrowserRouter>
        <Provider store={appStore}>
          <App />
        </Provider>
      </BrowserRouter>
    </React.StrictMode>
  )
}
