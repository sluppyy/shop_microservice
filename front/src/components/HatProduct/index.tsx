import styles from './hatProduct.module.css'
import { HatProduct as Model } from '@/models'

interface Props {
  product: Model
}

export default function HatProduct({ product }: Props) {
  return (
    <div className={`card ${styles['hatProduct']}`}>
      {product.preview_img_url ? (
        <img
          src={product.preview_img_url}
          alt={product.name + ' preview'}
          className={`card-img-top ${styles['hatProduct-img']}`}
        />
      ) : (
        <span
          className={`card-img-top placeholder ${styles['hatProduct-img']}`}
        />
      )}
      <div className="card-body">
        <div className="card-title">{product.name}</div>
        <div className="card-text">{product.description}</div>
        <button className="btn btn-primary mt-2">{product.price}</button>
      </div>
    </div>
  )
}

export function HatProductPlaceholder() {
  return (
    <div className={`card ${styles['hatProduct']} placeholder-wave`}>
      <span
        className={`card-img-top placeholder ${styles['hatProduct-img']}`}
      />
      <div className="card-body">
        <div className="card-title placeholder-glow">
          <span className="placeholder col-6"></span>
        </div>
        <div className="card-text placeholder-glow">
          <span className="placeholder col-7"></span>
          <span className="placeholder col-4"></span>
          <span className="placeholder col-8"></span>
        </div>
        <a className="btn btn-primary disabled placeholder col-4 mt-2"></a>
      </div>
    </div>
  )
}
