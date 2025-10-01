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
  ChevronDown,
  Facebook,
  Music2,
  Cloud
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
      {/* Main Header */}
      <header className={cn(
        "sticky top-0 z-50 transition-all duration-300 w-full relative overflow-hidden",
        scrolled ? "shadow-2xl" : "shadow-xl"
      )}
      style={{backgroundColor: '#8B2635'}}>
        {/* SVG Clouds - Natural Horizontal Drift */}
        <div className="absolute inset-0 overflow-hidden pointer-events-none">
          {/* Cloud 1 */}
          <svg className="absolute top-4 opacity-30 animate-cloud-drift-1" width="120" height="60" viewBox="0 0 120 60" style={{left: '-120px'}}>
            <path d="M 25,50 Q 0,50 0,35 Q 0,25 10,20 Q 10,10 25,10 Q 35,0 50,5 Q 65,0 75,10 Q 90,8 100,20 Q 110,25 110,35 Q 110,50 90,50 Z" fill="white" filter="url(#blur1)"/>
            <defs><filter id="blur1"><feGaussianBlur in="SourceGraphic" stdDeviation="2"/></filter></defs>
          </svg>
          
          {/* Cloud 2 */}
          <svg className="absolute top-3 opacity-30 animate-cloud-drift-2" width="140" height="70" viewBox="0 0 140 70" style={{left: '-140px'}}>
            <path d="M 30,60 Q 0,60 0,40 Q 0,28 15,22 Q 15,12 30,10 Q 42,0 58,5 Q 75,0 88,8 Q 105,5 120,18 Q 135,25 135,40 Q 135,60 110,60 Z" fill="white" filter="url(#blur2)"/>
            <defs><filter id="blur2"><feGaussianBlur in="SourceGraphic" stdDeviation="2"/></filter></defs>
          </svg>
          
          {/* Cloud 3 */}
          <svg className="absolute top-8 opacity-28 animate-cloud-drift-3" width="100" height="55" viewBox="0 0 100 55" style={{left: '-100px'}}>
            <path d="M 22,48 Q 0,48 0,33 Q 0,23 12,18 Q 12,10 25,8 Q 35,0 48,4 Q 62,0 72,10 Q 85,8 95,20 Q 100,28 100,35 Q 100,48 80,48 Z" fill="white" filter="url(#blur3)"/>
            <defs><filter id="blur3"><feGaussianBlur in="SourceGraphic" stdDeviation="2"/></filter></defs>
          </svg>
          
          {/* Cloud 4 */}
          <svg className="absolute top-6 opacity-28 animate-cloud-drift-4" width="80" height="45" viewBox="0 0 80 45" style={{left: '-80px'}}>
            <path d="M 18,40 Q 0,40 0,28 Q 0,20 10,15 Q 10,8 22,7 Q 30,0 42,3 Q 52,0 60,8 Q 70,7 78,18 Q 80,25 80,30 Q 80,40 65,40 Z" fill="white" filter="url(#blur4)"/>
            <defs><filter id="blur4"><feGaussianBlur in="SourceGraphic" stdDeviation="1.5"/></filter></defs>
          </svg>
          
          {/* Cloud 5 */}
          <svg className="absolute top-10 opacity-28 animate-cloud-drift-5" width="85" height="48" viewBox="0 0 85 48" style={{left: '-85px'}}>
            <path d="M 20,42 Q 0,42 0,30 Q 0,22 11,17 Q 11,9 24,8 Q 32,0 45,4 Q 56,0 65,10 Q 75,8 82,20 Q 85,27 85,32 Q 85,42 68,42 Z" fill="white" filter="url(#blur5)"/>
            <defs><filter id="blur5"><feGaussianBlur in="SourceGraphic" stdDeviation="1.5"/></filter></defs>
          </svg>
          
          {/* Cloud 6 */}
          <svg className="absolute top-5 opacity-26 animate-cloud-drift-6" width="90" height="50" viewBox="0 0 90 50" style={{left: '-90px'}}>
            <path d="M 20,45 Q 0,45 0,32 Q 0,24 12,19 Q 12,10 26,9 Q 35,0 48,5 Q 60,0 70,11 Q 80,9 87,22 Q 90,29 90,35 Q 90,45 72,45 Z" fill="white" filter="url(#blur6)"/>
            <defs><filter id="blur6"><feGaussianBlur in="SourceGraphic" stdDeviation="1.8"/></filter></defs>
          </svg>
          
          {/* Cloud 7 */}
          <svg className="absolute top-2 opacity-25 animate-cloud-drift-7" width="95" height="52" viewBox="0 0 95 52" style={{left: '-95px'}}>
            <path d="M 22,47 Q 0,47 0,34 Q 0,26 13,20 Q 13,11 28,10 Q 38,0 52,6 Q 65,0 75,12 Q 85,10 92,24 Q 95,31 95,37 Q 95,47 75,47 Z" fill="white" filter="url(#blur7)"/>
            <defs><filter id="blur7"><feGaussianBlur in="SourceGraphic" stdDeviation="1.8"/></filter></defs>
          </svg>
          
          {/* Cloud 8 */}
          <svg className="absolute top-12 opacity-27 animate-cloud-drift-8" width="75" height="42" viewBox="0 0 75 42" style={{left: '-75px'}}>
            <path d="M 16,38 Q 0,38 0,27 Q 0,20 9,16 Q 9,9 20,8 Q 28,0 40,4 Q 50,0 58,9 Q 66,8 73,19 Q 75,25 75,30 Q 75,38 60,38 Z" fill="white" filter="url(#blur8)"/>
            <defs><filter id="blur8"><feGaussianBlur in="SourceGraphic" stdDeviation="1.5"/></filter></defs>
          </svg>
        </div>
        <div className="container mx-auto px-4">
          <div className="flex justify-between items-center h-20 lg:h-24">
            {/* Logo - Enhanced */}
            <Link href="/" className="flex items-center space-x-3 lg:space-x-4 group relative z-10">
              <div className="relative w-16 h-16 lg:w-20 lg:h-20 rounded-full bg-gradient-to-br from-white to-neutral-50 shadow-xl overflow-hidden transition-all duration-500 group-hover:scale-110 group-hover:shadow-2xl group-hover:rotate-6">
                <div className="absolute inset-0 bg-gradient-to-tr from-transparent to-white/30"></div>
                <Image
                  src="/logo.png"
                  alt="Cielo Carnes y Fiambres"
                  fill
                  className="object-cover p-2 transition-transform duration-500 group-hover:scale-105"
                  priority
                />
              </div>
              <div className="transition-all duration-300 group-hover:translate-x-1">
                <h1 className="text-2xl lg:text-3xl font-extrabold text-white drop-shadow-2xl tracking-tight">Cielo</h1>
                <p className="text-sm lg:text-base text-neutral-900 font-bold drop-shadow-md">Carnes y Fiambres</p>
              </div>
            </Link>

            {/* Navigation with Cloud Buttons */}
            <nav className="hidden lg:flex items-center justify-center flex-1 gap-16">
              {navigation.map((item) => (
                <div key={item.name} className="relative group">
                  <Link
                    href={item.href}
                    className={cn(
                      'text-sm font-extrabold transition-all duration-500 flex flex-col items-center justify-center py-4 px-6 relative whitespace-nowrap overflow-visible group',
                      pathname === item.href
                        ? 'text-yellow-200 scale-105'
                        : 'text-yellow-300 hover:text-yellow-200 hover:scale-105'
                    )}
                    onMouseEnter={() => item.submenu && setActiveDropdown(item.name)}
                    onMouseLeave={() => setActiveDropdown(null)}
                  >
                    {/* Pig Head Icon */}
                    <svg className="w-12 h-12 mb-2 opacity-90 group-hover:opacity-100 transition-all group-hover:scale-110" viewBox="0 0 60 60" preserveAspectRatio="xMidYMid meet">
                      <defs>
                        <filter id={`pigHeadShadow-${item.name}`}>
                          <feDropShadow dx="0" dy="1" stdDeviation="1.5" floodOpacity="0.4"/>
                        </filter>
                      </defs>
                      
                      {/* Head - main circle */}
                      <circle cx="30" cy="32" r="20" fill="#f472b6" filter={`url(#pigHeadShadow-${item.name})`}/>
                      
                      {/* Left ear */}
                      <path d="M 18,15 L 12,8 L 20,12 Z" fill="#f472b6" filter={`url(#pigHeadShadow-${item.name})`}/>
                      
                      {/* Right ear */}
                      <path d="M 42,15 L 48,8 L 40,12 Z" fill="#f472b6" filter={`url(#pigHeadShadow-${item.name})`}/>
                      
                      {/* Snout */}
                      <ellipse cx="30" cy="38" rx="10" ry="8" fill="#fda4af" filter={`url(#pigHeadShadow-${item.name})`}/>
                      
                      {/* Left nostril */}
                      <ellipse cx="25" cy="38" rx="2.5" ry="3" fill="#be185d"/>
                      
                      {/* Right nostril */}
                      <ellipse cx="35" cy="38" rx="2.5" ry="3" fill="#be185d"/>
                      
                      {/* Left eye */}
                      <circle cx="22" cy="26" r="2.5" fill="#000000"/>
                      <circle cx="23" cy="25" r="1" fill="#ffffff"/>
                      
                      {/* Right eye */}
                      <circle cx="38" cy="26" r="2.5" fill="#000000"/>
                      <circle cx="39" cy="25" r="1" fill="#ffffff"/>
                      
                      {/* Mouth - opens when active */}
                      {pathname === item.href ? (
                        // Open mouth
                        <ellipse cx="30" cy="43" rx="4" ry="3" fill="#be185d"/>
                      ) : (
                        // Closed smile
                        <path d="M 26,42 Q 30,44 34,42" stroke="#be185d" strokeWidth="1.5" fill="none" strokeLinecap="round"/>
                      )}
                    </svg>
                    
                    <span className="relative z-10 drop-shadow-lg">{item.name}</span>
                    {item.submenu && (
                      <ChevronDown className="ml-1 h-3 w-3 transition-transform duration-500 group-hover:rotate-180 relative z-10" />
                    )}
                  </Link>
                  
                  {/* Dropdown */}
                  {item.submenu && activeDropdown === item.name && (
                    <div 
                      className="absolute top-full left-0 mt-3 w-56 bg-white rounded-xl shadow-2xl border border-neutral-100 py-3 animate-slide-down"
                      onMouseEnter={() => setActiveDropdown(item.name)}
                      onMouseLeave={() => setActiveDropdown(null)}
                    >
                      {item.submenu.map((subitem) => (
                        <Link
                          key={subitem.name}
                          href={subitem.href}
                          className="block px-5 py-2.5 text-sm text-neutral-700 hover:bg-primary-50 hover:text-primary-700 transition-colors font-medium"
                        >
                          {subitem.name}
                        </Link>
                      ))}
                    </div>
                  )}
                </div>
              ))}
            </nav>

            {/* Actions - Enhanced */}
            <div className="flex items-center space-x-4 lg:space-x-5 relative z-10">
              <button
                onClick={() => setSearchOpen(!searchOpen)}
                className="p-2.5 lg:p-3 text-white hover:bg-white/25 rounded-xl transition-all duration-300 hover:scale-110 hover:shadow-lg backdrop-blur-sm"
                aria-label="Buscar"
              >
                <Search className="h-5 w-5 lg:h-6 lg:w-6" />
              </button>

              <Link
                href="/account"
                className="hidden lg:flex items-center p-3 text-white hover:bg-white/25 rounded-xl transition-all duration-300 hover:scale-110 hover:shadow-lg backdrop-blur-sm"
                aria-label="Mi cuenta"
              >
                <User className="h-6 w-6" />
              </Link>

              <Link
                href="/cart"
                className="relative p-2.5 lg:p-3 text-white hover:bg-white/25 rounded-xl transition-all duration-300 hover:scale-110 hover:shadow-lg backdrop-blur-sm group"
                aria-label="Carrito"
              >
                <ShoppingCart className="h-5 w-5 lg:h-6 lg:w-6 transition-transform group-hover:rotate-12" />
                {cartItemsCount > 0 && (
                  <span className="absolute -top-1 -right-1 bg-gradient-to-br from-yellow-300 to-yellow-500 text-red-800 text-xs rounded-full h-6 w-6 flex items-center justify-center font-extrabold shadow-xl border-2 border-white animate-pulse">
                    {cartItemsCount > 99 ? '99+' : cartItemsCount}
                  </span>
                )}
              </Link>

              <button
                onClick={() => setMobileMenuOpen(!mobileMenuOpen)}
                className="lg:hidden p-2.5 text-white hover:bg-white/25 rounded-xl transition-all duration-300 hover:scale-110 hover:shadow-lg backdrop-blur-sm"
                aria-label="Menú"
              >
                {mobileMenuOpen ? <X className="h-6 w-6" /> : <Menu className="h-6 w-6" />}
              </button>
            </div>
          </div>
        </div>

        {/* Search Bar */}
        {searchOpen && (
          <div className="border-t border-neutral-200 bg-white animate-slide-down">
            <div className="container mx-auto px-4 py-4">
              <div className="relative max-w-xl mx-auto">
                <input
                  type="text"
                  placeholder="Buscar productos..."
                  className="w-full px-4 py-2.5 pr-10 border border-neutral-300 rounded-lg focus:outline-none focus:border-primary-500 focus:ring-1 focus:ring-primary-500"
                  autoFocus
                />
                <button className="absolute right-3 top-1/2 -translate-y-1/2 text-neutral-400">
                  <Search className="h-5 w-5" />
                </button>
              </div>
            </div>
          </div>
        )}

        {/* Mobile Menu */}
        {mobileMenuOpen && (
          <div className="lg:hidden border-t border-neutral-200 bg-white animate-slide-down">
            <div className="container mx-auto px-4 py-4 space-y-1">
              {navigation.map((item) => (
                <div key={item.name}>
                  <Link
                    href={item.href}
                    className={cn(
                      'block px-4 py-2.5 text-base font-medium rounded-md transition-colors',
                      pathname === item.href
                        ? 'text-primary-700 bg-primary-50'
                        : 'text-neutral-700 hover:bg-neutral-50'
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
                          className="block px-4 py-2 text-sm text-neutral-600 hover:text-primary-700"
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
                  className="flex items-center px-4 py-2.5 text-base font-medium text-neutral-700 hover:bg-neutral-50 rounded-md"
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
