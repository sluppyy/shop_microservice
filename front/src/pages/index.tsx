import { lazy } from 'react'

const Main = lazy(() => import('./Main'))
const NotFound = lazy(() => import('./NotFound'))
const HatProducts = lazy(() => import('./HatProducts'))
const Auth = lazy(() => import('./Auth'))
const Profile = lazy(() => import('./Profile'))

export default {
  Main,
  NotFound,
  HatProducts,
  Auth,
  Profile,
}
