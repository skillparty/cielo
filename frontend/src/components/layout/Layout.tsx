import { ReactNode } from 'react'
import Header from './Header'
import Footer from './Footer'
import ResponsiveTestHelper from '../dev/ResponsiveTestHelper'

interface LayoutProps {
  children: ReactNode
}

export default function Layout({ children }: LayoutProps) {
  return (
    <div className="min-h-screen w-full flex flex-col bg-gray-50">
      <Header />
      <main className="flex-1 w-full">
        {children}
      </main>
      <Footer />
      <ResponsiveTestHelper />
    </div>
  )
}
