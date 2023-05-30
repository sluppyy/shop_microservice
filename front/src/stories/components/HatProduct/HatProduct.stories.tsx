import type { Meta, StoryObj } from '@storybook/react'

import HatProduct from '@/components/HatProduct'
import '@/index.scss'
import 'bootstrap-icons/font/bootstrap-icons.min.css'

const meta: Meta<typeof HatProduct> = {
  title: 'Components/HatProduct',
  component: HatProduct,
}

export default meta
type Story = StoryObj<typeof HatProduct>

const product = {
  id: 1,
  name: 'Шляпа',
  description: 'Чмокни, чтобы жить!',
  model: 'model',
  custom_model_data: 0,
  preview_img_url: '/storage/images/products/hat/test.png',
  price: 999,
}

export const Light: Story = {
  args: {
    product,
  },
  render(props) {
    return (
      <div data-bs-theme="light">
        <HatProduct {...props} />
      </div>
    )
  },
}

export const Dark: Story = {
  args: { product },
  render(props) {
    return (
      <div data-bs-theme="dark">
        <HatProduct {...props} />
      </div>
    )
  },
}
