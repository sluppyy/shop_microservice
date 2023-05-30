export interface HatProduct {
  readonly id: number
  readonly name: string
  readonly description: string
  readonly preview_img_url: string | null
  readonly price: number
  readonly model: string
  readonly custom_model_data: number
}
