import _axios from 'axios'
const axios = _axios.create({
  baseURL: import.meta.env.VITE_BASE_URL,
})

export interface FindHatProductsOk {
  data: {
    id: number
    name: string
    description: string
    preview_img_url: string
    price: number
    model: string
    custom_model_data: string
  }[]
  meta: {
    current_page: number
    from: number
    last_page: number
    per_page: number
    to: number
    total: number
  }
}
export type FindHatProductsResponse =
  | {
      code: 'ok'
      products: FindHatProductsOk
    }
  | {
      code: 'error'
    }
export async function findHatProducts(
  perPage = 15,
  page = 1
): Promise<FindHatProductsResponse> {
  try {
    const res = await axios.get('/products/hat', { params: { perPage, page } })
    return { code: 'ok', products: res.data }
  } catch (error) {
    return { code: 'error' }
  }
}
