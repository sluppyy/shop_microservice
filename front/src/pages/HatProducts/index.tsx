import { useAppSelector } from '@/store'

export default function Products() {
  const { status } = useAppSelector((state) => state.hatProducts)

  if (status == 'unknown') return <></>
  if (status == 'error') return <div></div>

  return <div>Products</div>
}
