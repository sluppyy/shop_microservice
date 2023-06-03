import _axios from 'axios'
import { tokens } from './auth'
const axios = _axios.create({
  baseURL: import.meta.env.VITE_BASE_URL + '/api',
})

export interface FindHatProductsOk {
  data: {
    id: number
    name: string
    description: string
    preview_img_url: string
    price: number
    model: string
    custom_model_data: number
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

export type GetBalanceResponse =
  | {
      code: 'ok'
      data: {
        user_id: string
        candies: number
      }
    }
  | {
      code: 'error'
    }
export async function getBalance(): Promise<GetBalanceResponse> {
  if (!tokens.accessToken) return { code: 'error' }
  try {
    const res = await axios.get('/balance', {
      headers: { Authorization: `Bearer ${tokens.accessToken}` },
    })
    return {
      code: 'ok',
      data: res.data.data,
    }
  } catch (error) {
    return { code: 'error' }
  }
}

export interface GetHatInventoryOk {
  data: {
    count: number
    product: {
      id: number
      name: string
      description: string
      preview_img_url?: string | null
    }
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
export type GetHatInventoryResponse =
  | {
      code: 'ok'
      products: GetHatInventoryOk
    }
  | {
      code: 'error'
    }
export async function getHatInventory(
  perPage = 15,
  page = 1
): Promise<GetHatInventoryResponse> {
  if (!tokens.accessToken) return { code: 'error' }
  try {
    const res = await axios.get(`/inventories/hat`, {
      params: { perPage, page },
      headers: { Authorization: `Bearer ${tokens.accessToken}` },
    })
    return { code: 'ok', products: res.data }
  } catch (error) {
    return { code: 'error' }
  }
}
