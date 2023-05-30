import HatProduct, { HatProductPlaceholder } from '@/components/HatProduct'
import { useAppDispatch, useAppSelector } from '@/store'
import { loadNextPage } from '@/store/hatProducts'
import { useLayoutEffect } from 'react'

export default function Products() {
  const dispatch = useAppDispatch()
  const { status, products } = useAppSelector((state) => state.hatProducts)

  useLayoutEffect(() => {
    dispatch(loadNextPage({ page: 1 }))
  }, [])

  if (status == 'unknown') return <></>
  if (status == 'error') return <div>{':('}</div>
  if (status == 'loading')
    <div className="container">
      <div className="row row g-4">
        {Array(20)
          .fill(0)
          .map((_, i) => (
            <div key={i} className="col-auto">
              <HatProductPlaceholder />
            </div>
          ))}
      </div>
    </div>

  return (
    <div className="container">
      <div className="row g-4">
        {products &&
          products.map((product) => (
            <div key={product.id} className="col-auto">
              <HatProduct product={product} />
            </div>
          ))}
      </div>
    </div>
  )
}
