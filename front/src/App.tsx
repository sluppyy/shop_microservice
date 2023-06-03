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
            <Route index path="/" element={<Pages.Main />} />
            <Route index path="/auth" element={<Pages.Auth />} />
            <Route index path="/profile" element={<Pages.Profile />} />
            <Route path="/products/hats" element={<Pages.HatProducts />} />
            <Route path="/hatInventory" element={<Pages.HatInventory />} />
            <Route path="*" element={<Pages.NotFound />} />
          </Routes>
        </Suspense>
      </main>
    </>
  )
}
