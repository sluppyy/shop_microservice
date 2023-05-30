import type { Meta, StoryObj } from '@storybook/react'
import '@/index.scss'

import Header from '@/components/Header'
import { BrowserRouter } from 'react-router-dom'

const meta: Meta<typeof Header> = {
  title: 'Components/Header',
  component: Header,
}

export default meta
type Story = StoryObj<typeof Header>

export const Light: Story = {
  render() {
    return (
      <BrowserRouter>
        <body data-bs-theme="light">
          <Header />
        </body>
      </BrowserRouter>
    )
  },
}

export const Dark: Story = {
  render() {
    return (
      <BrowserRouter>
        <body data-bs-theme="dark">
          <Header />
        </body>
      </BrowserRouter>
    )
  },
}
