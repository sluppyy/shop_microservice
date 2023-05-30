import type { Meta, StoryObj } from '@storybook/react'
import '@/index.scss'
import 'bootstrap-icons/font/bootstrap-icons.min.css'

import Header from '@/components/Header'
import { BrowserRouter } from 'react-router-dom'
import { store } from '@/store'
import { Provider } from 'react-redux'
import { toggle } from '@/store/theme'

const meta: Meta<typeof Header> = {
  title: 'Components/Header',
  component: Header,
}

export default meta
type Story = StoryObj<typeof Header>

const lightStore = store()
lightStore.dispatch(toggle())
export const Light: Story = {
  render() {
    return (
      <BrowserRouter>
        <Provider store={lightStore}>
          <body id="theme-handler">
            <Header />
          </body>
        </Provider>
      </BrowserRouter>
    )
  },
}

const darkStore = store()
export const Dark: Story = {
  render() {
    return (
      <BrowserRouter>
        <Provider store={darkStore}>
          <body id="theme-handler">
            <Header />
          </body>
        </Provider>
      </BrowserRouter>
    )
  },
}
