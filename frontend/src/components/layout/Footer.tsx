import Link from 'next/link'
import Image from 'next/image'
import { 
  Phone, 
  Mail, 
  MapPin, 
  Clock, 
  Facebook, 
  Instagram, 
  MessageCircle,
  CreditCard,
  Truck,
  Shield,
  Award,
  Music2
} from 'lucide-react'

export default function Footer() {
  const currentYear = new Date().getFullYear()

  return (
    <footer className="bg-neutral-900 w-full">
      {/* Features Bar */}
      <div className="bg-primary-700 py-4 w-full">
        <div className="container mx-auto px-4">
          <div className="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div className="flex items-center space-x-2 text-white">
              <Truck className="h-6 w-6" />
              <div>
                <p className="font-semibold text-xs">Envío Rápido</p>
              </div>
            </div>
            <div className="flex items-center space-x-2 text-white">
              <Shield className="h-6 w-6" />
              <div>
                <p className="font-semibold text-xs">Calidad Premium</p>
              </div>
            </div>
            <div className="flex items-center space-x-2 text-white">
              <CreditCard className="h-6 w-6" />
              <div>
                <p className="font-semibold text-xs">Pago Seguro</p>
              </div>
            </div>
            <div className="flex items-center space-x-2 text-white">
              <Award className="h-6 w-6" />
              <div>
                <p className="font-semibold text-xs">20+ Años</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      {/* Main Footer */}
      <div className="container mx-auto px-4 py-8">
        <div className="grid grid-cols-1 md:grid-cols-4 gap-6">
          
          {/* Company Info */}
          <div>
            <div className="flex items-center mb-3">
              <div className="relative w-10 h-10 mr-2">
                <Image
                  src="/logo.png"
                  alt="Cielo Carnes y Fiambres"
                  fill
                  className="object-contain"
                />
              </div>
              <div>
                <h3 className="text-base font-bold text-white">Cielo</h3>
                <p className="text-xs text-secondary-400">Carnes y Fiambres</p>
              </div>
            </div>
            
            <p className="text-neutral-400 mb-4 text-xs leading-relaxed">
              Más de 20 años ofreciendo productos porcinos de calidad.
            </p>
            
            <div className="space-y-2">
              <a href="tel:69420542" className="flex items-center text-white hover:text-secondary-400 transition-colors text-sm">
                <Phone className="h-3.5 w-3.5 mr-1.5" />
                <span className="font-semibold">69420542</span>
              </a>
              <div className="flex gap-2">
                <a 
                  href="https://www.facebook.com/CarnesyFiambresCielo" 
                  target="_blank" 
                  rel="noopener noreferrer"
                  className="bg-neutral-800 p-2 rounded hover:bg-blue-600 transition-colors"
                  aria-label="Facebook"
                >
                  <Facebook className="h-4 w-4 text-white" />
                </a>
                <a 
                  href="https://www.tiktok.com/@cielocarnesyfiambres" 
                  target="_blank" 
                  rel="noopener noreferrer"
                  className="bg-neutral-800 p-2 rounded hover:bg-gray-700 transition-colors"
                  aria-label="TikTok"
                >
                  <Music2 className="h-4 w-4 text-white" />
                </a>
                <a 
                  href="https://wa.me/59169420542" 
                  target="_blank" 
                  rel="noopener noreferrer"
                  className="bg-neutral-800 p-2 rounded hover:bg-green-600 transition-colors"
                  aria-label="WhatsApp"
                >
                  <MessageCircle className="h-4 w-4 text-white" />
                </a>
              </div>
            </div>
          </div>

          {/* Enlaces */}
          <div>
            <h4 className="text-white font-semibold mb-3 text-xs uppercase">Enlaces</h4>
            <ul className="space-y-1.5">
              <li>
                <Link href="/" className="text-neutral-400 hover:text-white transition-colors text-xs">
                  Inicio
                </Link>
              </li>
              <li>
                <Link href="/about" className="text-neutral-400 hover:text-white transition-colors text-xs">
                  Nosotros
                </Link>
              </li>
              <li>
                <Link href="/shop" className="text-neutral-400 hover:text-white transition-colors text-xs">
                  Tienda
                </Link>
              </li>
              <li>
                <Link href="/recipes-simple" className="text-neutral-400 hover:text-white transition-colors text-xs">
                  Recetas
                </Link>
              </li>
              <li>
                <Link href="/contact" className="text-neutral-400 hover:text-white transition-colors text-xs">
                  Contacto
                </Link>
              </li>
            </ul>
          </div>

          {/* Productos */}
          <div>
            <h4 className="text-white font-semibold mb-3 text-xs uppercase">Productos</h4>
            <ul className="space-y-1.5">
              <li>
                <Link href="/shop?category=embutidos" className="text-neutral-400 hover:text-white transition-colors text-xs">
                  Embutidos
                </Link>
              </li>
              <li>
                <Link href="/shop?category=fiambres" className="text-neutral-400 hover:text-white transition-colors text-xs">
                  Fiambres
                </Link>
              </li>
              <li>
                <Link href="/shop?category=carnes-rojas" className="text-neutral-400 hover:text-white transition-colors text-xs">
                  Cortes Frescos
                </Link>
              </li>
              <li>
                <Link href="/shop?ofertas=true" className="text-secondary-400 hover:text-secondary-300 transition-colors text-xs font-semibold">
                  Ofertas
                </Link>
              </li>
            </ul>
          </div>

          {/* Horarios */}
          <div>
            <h4 className="text-white font-semibold mb-3 text-xs uppercase">Horarios</h4>
            <div className="space-y-1 text-xs">
              <p className="text-neutral-400">Lun-Sáb: <span className="text-white">8:00-20:00</span></p>
              <p className="text-neutral-400">Dom: <span className="text-white">9:00-14:00</span></p>
            </div>
            
            <h4 className="text-white font-semibold mb-3 mt-4 text-xs uppercase">Legal</h4>
            <ul className="space-y-1.5">
              <li>
                <Link href="/privacy" className="text-neutral-400 hover:text-white transition-colors text-xs">
                  Privacidad
                </Link>
              </li>
              <li>
                <Link href="/terms" className="text-neutral-400 hover:text-white transition-colors text-xs">
                  Términos
                </Link>
              </li>
              <li>
                <Link href="/faq" className="text-neutral-400 hover:text-white transition-colors text-xs">
                  FAQ
                </Link>
              </li>
            </ul>
          </div>
        </div>

        {/* Copyright */}
        <div className="mt-8 pt-6 border-t border-neutral-800 text-center">
          <p className="text-neutral-500 text-xs">
            &copy; {currentYear} <span className="text-white">Cielo Carnes y Fiambres</span>. Todos los derechos reservados.
          </p>
        </div>
      </div>
    </footer>
  )
}
