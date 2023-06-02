import HatProduct, { HatProductPlaceholder } from '@/components/HatProduct'
import { useAppDispatch, useAppSelector } from '@/store'
import { loadNextPage } from '@/store/hatProducts'
import { useLayoutEffect } from 'react'
import styles from './hatProducts.module.css'
import { Link, useSearchParams } from 'react-router-dom'

function usePagination() {
  const [searchParams] = useSearchParams()

  const page = searchParams.get('page')
  const perPage = searchParams.get('perPage')

  return [Number(page) || 1, Number(perPage) || null] as const
}

export default function Products() {
  const dispatch = useAppDispatch()
  const { status, products, pages } = useAppSelector(
    (state) => state.hatProducts
  )
  const [page, perPage] = usePagination()

  useLayoutEffect(() => {
    dispatch(loadNextPage({ page, perPage: perPage ?? undefined }))
  }, [page, perPage])

  if (status == 'unknown') return <></>
  if (status == 'error') return <div>{':('}</div>
  if (status == 'loading')
    <div className={`flex-fill ${styles['block']}`}>
      <div className="row w-100 g-4 row-cols-auto justify-content-center">
        {Array(20)
          .fill(0)
          .map((_, i) => (
            <div key={i} className="col-auto">
              <HatProductPlaceholder />
            </div>
          ))}
      </div>
    </div>

  const previous = {
    class: page - 1 <= 0 ? 'disabled' : '',
    href:
      page - 1 > 0 ? `/products/hats/?page=${page - 1}&perPage=${perPage}` : '',
  }

  const next = {
    class: page + 1 > (pages ?? page) ? 'disabled' : '',
    href:
      page + 1 <= (pages ?? page)
        ? `/products/hats/?page=${page + 1}&perPage=${perPage}`
        : '',
  }

  return (
    <div className="container flex-fill">
      <div className={`w-100 ${styles['block']}`}>
        <div className="row w-100 g-4 row-cols-auto justify-content-center">
          {products &&
            products.map((product) => (
              <div key={product.id} className="col col-auto">
                <HatProduct product={product} />
              </div>
            ))}
        </div>
      </div>

      {(pages ?? 0) > 1 && (
        <nav>
          <ul className="pagination justify-content-center">
            <li className="page-item">
              <Link
                className={`page-link ${previous.class}`}
                to={previous.href}
              >
                <span aria-hidden="true">&laquo;</span>
              </Link>
            </li>
            {Array(pages)
              .fill(0)
              .map((_, i) => i + 1)
              .map((i) => (
                <li
                  className={`page-item ${page == i ? 'active' : ''}`}
                  key={i}
                >
                  <Link
                    className="page-link"
                    to={`/products/hats/?page=${i}&perPage=${perPage}`}
                  >
                    {i}
                  </Link>
                </li>
              ))}
            <li className="page-item">
              <Link className={`page-link ${next.class}`} to={next.href}>
                <span aria-hidden="true">&raquo;</span>
              </Link>
            </li>
          </ul>
        </nav>
      )}
    </div>
  )
}
