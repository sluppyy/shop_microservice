import type { Meta, StoryObj } from '@storybook/react'

import { HatProductPlaceholder } from '@/components/HatProduct'
import '@/index.scss'
import 'bootstrap-icons/font/bootstrap-icons.min.css'

const meta: Meta<typeof HatProductPlaceholder> = {
  title: 'Components/HatProduct/Placeholder',
  component: HatProductPlaceholder,
}

export default meta
type Story = StoryObj<typeof HatProductPlaceholder>

export const Light: Story = {
  render() {
    return (
      <div data-bs-theme="light">
        <HatProductPlaceholder />
      </div>
    )
  },
}

export const Dark: Story = {
  render() {
    return (
      <div data-bs-theme="dark">
        <HatProductPlaceholder />
      </div>
    )
  },
}
