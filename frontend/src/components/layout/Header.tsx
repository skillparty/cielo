'use client'

import { useState, useEffect } from 'react'
import Link from 'next/link'
import Image from 'next/image'
import { usePathname } from 'next/navigation'
import { cn } from '@/lib/utils'
import { useCart } from '@/hooks/useCart'
import { 
  ShoppingCart, 
  Search, 
  Menu, 
  X, 
  User, 
  Phone,
  MapPin,
  Clock,
  ChevronDown
} from 'lucide-react'

interface NavItem {
  name: string
  href: string
  submenu?: { name: string; href: string }[]
}

const navigation: NavItem[] = [
  { name: 'Inicio', href: '/' },
  { name: 'Nosotros', href: '/about' },
  { 
    name: 'Tienda', 
    href: '/shop',
    submenu: [
      { name: 'Carnes Rojas', href: '/shop?category=carnes-rojas' },
      { name: 'Carnes Blancas', href: '/shop?category=carnes-blancas' },
      { name: 'Embutidos', href: '/shop?category=embutidos' },
      { name: 'Fiambres', href: '/shop?category=fiambres' },
      { name: 'Ofertas', href: '/shop?ofertas=true' },
    ]
  },
  { name: 'Recetas', href: '/recipes-simple' },
  { name: 'Contacto', href: '/contact' },
]

export default function Header() {
  const [mobileMenuOpen, setMobileMenuOpen] = useState(false)
  const [searchOpen, setSearchOpen] = useState(false)
  const [scrolled, setScrolled] = useState(false)
  const [activeDropdown, setActiveDropdown] = useState<string | null>(null)
  const pathname = usePathname()
  const { cart } = useCart()

  useEffect(() => {
    const handleScroll = () => {
      setScrolled(window.scrollY > 10)
    }
    window.addEventListener('scroll', handleScroll)
    return () => window.removeEventListener('scroll', handleScroll)
  }, [])

  const cartItemsCount = cart?.items?.reduce((sum, item) => sum + item.quantity, 0) || 0

  return (
    <>
      {/* Top Bar */}
      <div className="bg-primary-900 text-white py-2 hidden lg:block w-full">
        <div className="w-full mx-auto px-4 sm:px-6 lg:px-8 xl:px-12 2xl:px-16">
          <div className="flex justify-between items-center text-sm">
            <div className="flex items-center space-x-4 xl:space-x-6">
              <a href="tel:+59169420542" className="flex items-center hover:text-secondary-400 transition-colors">
                <Phone className="w-4 h-4 mr-1" />
                <span className="hidden xl:inline">+591 69420542</span>
                <span className="xl:hidden">69420542</span>
              </a>
              <div className="flex items-center">
                <MapPin className="w-4 h-4 mr-1" />
                <span className="hidden xl:inline">Av. Siempre Viva 123, Santa Cruz</span>
                <span className="xl:hidden">Santa Cruz</span>
              </div>
            </div>
            <div className="flex items-center">
              <Clock className="w-4 h-4 mr-1" />
              <span className="hidden xl:inline">Lun-Sab: 8:00 - 20:00 | Dom: 9:00 - 14:00</span>
              <span className="xl:hidden">8:00 - 20:00</span>
            </div>
          </div>
        </div>
      </div>

      {/* Main Header */}
      <header className={cn(
        "bg-white sticky top-0 z-50 transition-all duration-300 w-full",
        scrolled ? "shadow-medium" : "shadow-soft"
      )}>
        <div className="w-full mx-auto px-3 sm:px-4 md:px-6 lg:px-8 xl:px-12 2xl:px-16">
          <div className="flex justify-between items-center h-16 sm:h-18 md:h-20">
            {/* Logo */}
            <div className="flex items-center">
              <Link href="/" className="flex items-center group">
                <div className="relative w-12 h-12 sm:w-14 sm:h-14 md:w-16 md:h-16 mr-2 sm:mr-3 transition-transform group-hover:scale-105">
                  <Image
                    src="/logo.png"
                    alt="Cielo Carnes"
                    fill
                    className="object-contain"
                    priority
                  />
                </div>
                <div className="hidden sm:block">
                  <h1 className="text-lg sm:text-xl md:text-2xl font-display font-bold text-primary-700">Cielo Carnes</h1>
                  <p className="text-xs text-neutral-600 hidden md:block">Tradición y Calidad desde 2003</p>
                </div>
              </Link>
            </div>

            {/* Desktop Navigation */}
            <nav className="hidden lg:flex items-center space-x-1">
              {navigation.map((item) => (
                <div key={item.name} className="relative group">
                  <Link
                    href={item.href}
                    className={cn(
                      'px-4 py-2 text-sm font-medium transition-all duration-200 flex items-center',
                      pathname === item.href
                        ? 'text-primary-700'
                        : 'text-neutral-700 hover:text-primary-700'
                    )}
                    onMouseEnter={() => item.submenu && setActiveDropdown(item.name)}
                    onMouseLeave={() => setActiveDropdown(null)}
                  >
                    {item.name}
                    {item.submenu && (
                      <ChevronDown className="ml-1 h-4 w-4 transition-transform group-hover:rotate-180" />
                    )}
                  </Link>
                  
                  {/* Dropdown Menu */}
                  {item.submenu && activeDropdown === item.name && (
                    <div 
                      className="absolute top-full left-0 mt-1 w-56 bg-white rounded-lg shadow-strong py-2 animate-slide-down"
                      onMouseEnter={() => setActiveDropdown(item.name)}
                      onMouseLeave={() => setActiveDropdown(null)}
                    >
                      {item.submenu.map((subitem) => (
                        <Link
                          key={subitem.name}
                          href={subitem.href}
                          className="block px-4 py-2 text-sm text-neutral-700 hover:bg-primary-50 hover:text-primary-700 transition-colors"
                        >
                          {subitem.name}
                        </Link>
                      ))}
                    </div>
                  )}
                </div>
              ))}
            </nav>

            {/* Right Actions */}
            <div className="flex items-center space-x-2 sm:space-x-3">
              {/* Search Button */}
              <button
                onClick={() => setSearchOpen(!searchOpen)}
                className="p-1.5 sm:p-2 text-neutral-600 hover:text-primary-700 transition-colors"
              >
                <Search className="h-4 w-4 sm:h-5 sm:w-5" />
              </button>

              {/* User Account */}
              <Link
                href="/account"
                className="p-1.5 sm:p-2 text-neutral-600 hover:text-primary-700 transition-colors hidden sm:block"
              >
                <User className="h-4 w-4 sm:h-5 sm:w-5" />
              </Link>

              {/* Cart */}
              <Link
                href="/cart"
                className="relative p-1.5 sm:p-2 text-neutral-600 hover:text-primary-700 transition-colors"
              >
                <ShoppingCart className="h-4 w-4 sm:h-5 sm:w-5" />
                {cartItemsCount > 0 && (
                  <span className="absolute -top-0.5 -right-0.5 sm:-top-1 sm:-right-1 bg-primary-700 text-white text-xs rounded-full h-4 w-4 sm:h-5 sm:w-5 flex items-center justify-center font-semibold">
                    {cartItemsCount > 99 ? '99+' : cartItemsCount}
                  </span>
                )}
              </Link>

              {/* Mobile Menu Button */}
              <button
                onClick={() => setMobileMenuOpen(!mobileMenuOpen)}
                className="lg:hidden p-1.5 sm:p-2 text-neutral-600 hover:text-primary-700 transition-colors"
              >
                {mobileMenuOpen ? (
                  <X className="h-5 w-5 sm:h-6 sm:w-6" />
                ) : (
                  <Menu className="h-5 w-5 sm:h-6 sm:w-6" />
                )}
              </button>
            </div>
          </div>
        </div>

        {/* Search Bar */}
        {searchOpen && (
          <div className="border-t border-neutral-200 bg-white animate-slide-down w-full">
            <div className="w-full mx-auto px-3 sm:px-4 md:px-6 lg:px-8 xl:px-12 2xl:px-16 py-3 sm:py-4">
              <div className="relative">
                <input
                  type="text"
                  placeholder="Buscar productos, recetas..."
                  className="w-full px-3 sm:px-4 py-2 pr-8 sm:pr-10 text-sm sm:text-base border border-neutral-300 rounded-lg focus:outline-none focus:border-primary-500 focus:ring-1 focus:ring-primary-500"
                  autoFocus
                />
                <button className="absolute right-2 top-1/2 -translate-y-1/2 text-primary-700">
                  <Search className="h-4 w-4 sm:h-5 sm:w-5" />
                </button>
              </div>
            </div>
          </div>
        )}

        {/* Mobile Menu */}
        {mobileMenuOpen && (
          <div className="lg:hidden border-t border-neutral-200 bg-white animate-slide-down">
            <div className="px-3 sm:px-4 py-3 sm:py-4 space-y-1">
              {navigation.map((item) => (
                <div key={item.name}>
                  <Link
                    href={item.href}
                    className={cn(
                      'block px-3 py-2 text-base font-medium rounded-lg transition-colors',
                      pathname === item.href
                        ? 'text-primary-700 bg-primary-50'
                        : 'text-neutral-700 hover:text-primary-700 hover:bg-neutral-50'
                    )}
                    onClick={() => setMobileMenuOpen(false)}
                  >
                    {item.name}
                  </Link>
                  {item.submenu && (
                    <div className="ml-4 mt-1 space-y-1">
                      {item.submenu.map((subitem) => (
                        <Link
                          key={subitem.name}
                          href={subitem.href}
                          className="block px-3 py-1 text-sm text-neutral-600 hover:text-primary-700"
                          onClick={() => setMobileMenuOpen(false)}
                        >
                          {subitem.name}
                        </Link>
                      ))}
                    </div>
                  )}
                </div>
              ))}
              
              <div className="border-t border-neutral-200 pt-4 mt-4">
                <Link
                  href="/account"
                  className="flex items-center px-3 py-2 text-base font-medium text-neutral-700 hover:text-primary-700 hover:bg-neutral-50 rounded-lg"
                  onClick={() => setMobileMenuOpen(false)}
                >
                  <User className="h-5 w-5 mr-2" />
                  Mi Cuenta
                </Link>
              </div>
            </div>
          </div>
        )}
      </header>
    </>
  )
}
