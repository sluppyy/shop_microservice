import { Route, Routes } from 'react-router-dom'
import Header from './components/Header'
import { Suspense } from 'react'
import Preloader from './components/Preloader'
import Pages from './pages'

export default function App() {
  return (
    <>
      <Header />
      <main style={{ flex: 1 }}>
        <Suspense fallback={<Preloader />}>
          <Routes>
            <Route path="/" element={<Pages.Main />} />
            <Route path="/products/hats" element={<Pages.HatProducts />} />
            <Route path="*" element={<Pages.NotFound />} />
          </Routes>
        </Suspense>
      </main>
    </>
  )
}
