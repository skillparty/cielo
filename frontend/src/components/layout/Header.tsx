'use client'

import { useState } from 'react'
import Link from 'next/link'
import { usePathname } from 'next/navigation'
import { ShoppingCartIcon, UserIcon, Bars3Icon, XMarkIcon } from '@heroicons/react/24/outline'
import { cn } from '@/lib/utils'
import Button from '@/components/ui/Button'
import { useCart } from '@/hooks/useCart'

const navigation = [
  { name: 'Inicio', href: '/' },
  { name: 'Tienda', href: '/shop' },
  { name: 'Nosotros', href: '/about' },
  { name: 'Recetas', href: '/recipes-simple' },
  { name: 'Contacto', href: '/contact' },
]

export default function Header() {
  const [mobileMenuOpen, setMobileMenuOpen] = useState(false)
  const pathname = usePathname()
  const { cart } = useCart()

  return (
    <header className="bg-white shadow-sm border-b border-neutral-200 sticky top-0 z-50">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex justify-between items-center h-16">
          {/* Logo */}
          <div className="flex items-center">
            <Link href="/" className="flex items-center">
              <div className="h-10 w-10 bg-primary-700 rounded-lg flex items-center justify-center">
                <span className="text-white font-bold text-lg">C</span>
              </div>
              <span className="ml-2 text-xl font-bold text-primary-700">Cielo Carnes</span>
            </Link>
          </div>

          {/* Desktop Navigation */}
          <nav className="hidden md:flex space-x-8">
            {navigation.map((item) => (
              <Link
                key={item.name}
                href={item.href}
                className={cn(
                  'px-3 py-2 text-sm font-medium transition-colors',
                  pathname === item.href
                    ? 'text-red-600 border-b-2 border-red-600'
                    : 'text-gray-700 hover:text-red-600'
                )}
              >
                {item.name}
              </Link>
            ))}
          </nav>

          {/* User Actions */}
          <div className="flex items-center space-x-4">
            {/* Cart Icon */}
            <Link
              href="/cart"
              className="text-gray-700 hover:text-red-600 transition-colors relative p-2"
            >
              <ShoppingCartIcon className="h-6 w-6" />
              {cart.count > 0 && (
                <span className="absolute -top-1 -right-1 bg-red-600 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                  {cart.count > 99 ? '99+' : cart.count}
                </span>
              )}
            </Link>

            {/* User Menu */}
            <div className="hidden md:flex items-center space-x-2">
              <Button variant="ghost" size="sm">
                <UserIcon className="h-4 w-4 mr-1" />
                Iniciar Sesión
              </Button>
              <Button size="sm">
                Registrarse
              </Button>
            </div>

            {/* Mobile menu button */}
            <button
              type="button"
              className="md:hidden text-gray-700 hover:text-red-600 p-2"
              onClick={() => setMobileMenuOpen(!mobileMenuOpen)}
            >
              {mobileMenuOpen ? (
                <XMarkIcon className="h-6 w-6" />
              ) : (
                <Bars3Icon className="h-6 w-6" />
              )}
            </button>
          </div>
        </div>

        {/* Mobile Navigation Menu */}
        {mobileMenuOpen && (
          <div className="md:hidden border-t border-gray-200 py-4">
            <div className="space-y-1">
              {navigation.map((item) => (
                <Link
                  key={item.name}
                  href={item.href}
                  className={cn(
                    'block px-3 py-2 text-base font-medium transition-colors',
                    pathname === item.href
                      ? 'text-red-600 bg-red-50'
                      : 'text-gray-700 hover:text-red-600 hover:bg-gray-50'
                  )}
                  onClick={() => setMobileMenuOpen(false)}
                >
                  {item.name}
                </Link>
              ))}
              <div className="border-t border-gray-200 pt-4 mt-4 space-y-2">
                <Button variant="ghost" size="sm" className="w-full justify-start">
                  <UserIcon className="h-4 w-4 mr-2" />
                  Iniciar Sesión
                </Button>
                <Button size="sm" className="w-full">
                  Registrarse
                </Button>
              </div>
            </div>
          </div>
        )}
      </div>
    </header>
  )
}
