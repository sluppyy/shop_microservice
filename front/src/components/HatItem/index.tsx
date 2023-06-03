import styles from './hatItem.module.css'

interface Props {
  item: {
    count: number
    product: {
      id: number
      name: string
      description: string
      preview_img_url: string | null
    }
  }
}

export default function HatProduct({ item }: Props) {
  return (
    <div className={`card ${styles['hatProduct']}`}>
      {item.product.preview_img_url ? (
        <img
          src={item.product.preview_img_url}
          alt={item.product.name + ' preview'}
          className={`card-img-top ${styles['hatProduct-img']}`}
        />
      ) : (
        <span
          className={`card-img-top placeholder ${styles['hatProduct-img']}`}
        />
      )}
      <div className="card-body">
        <div className="card-title">{item.product.name}</div>
        <div className="card-text">{item.product.description}</div>
      </div>
      <div className="card-footer">{item.count}</div>
    </div>
  )
}

export function HatItemPlaceholder() {
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
