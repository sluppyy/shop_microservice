import styles from './hatProduct.module.css'

export default function HatProduct() {
  return <div>index</div>
}

export function HatProductPlaceholder() {
  return (
    <div className={`card ${styles['placeholder']} placeholder-wave`}>
      <span
        className={`card-img-top placeholder ${styles['placeholder-img']}`}
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
        <div className="card-footer">
          <a className="btn btn-primary disabled placeholder col-4"></a>
        </div>
      </div>
    </div>
  )
}
