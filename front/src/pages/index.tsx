import { lazy } from 'react'

const Main = lazy(() => import('./Main'))
const NotFound = lazy(() => import('./NotFound'))
const HatProducts = lazy(() => import('./HatProducts'))

export default {
  Main,
  NotFound,
  HatProducts,
}
