import { lazy } from 'react'

const Main = lazy(() => import('./Main'))
const NotFound = lazy(() => import('./NotFound'))

export default {
  Main,
  NotFound,
}
