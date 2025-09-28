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
  Award
} from 'lucide-react'

export default function Footer() {
  const currentYear = new Date().getFullYear()

  return (
    <footer className="bg-gradient-to-b from-neutral-900 to-neutral-950 w-full">
      {/* Features Bar */}
      <div className="bg-primary-700 py-4 sm:py-6 w-full">
        <div className="w-full mx-auto px-3 sm:px-4 md:px-6 lg:px-8 xl:px-12 2xl:px-16">
          <div className="grid grid-cols-2 md:grid-cols-4 gap-3 sm:gap-4 md:gap-6">
            <div className="flex items-center justify-center md:justify-start space-x-2 sm:space-x-3 text-white">
              <Truck className="h-6 w-6 sm:h-7 sm:w-7 md:h-8 md:w-8 flex-shrink-0" />
              <div>
                <p className="font-semibold text-sm sm:text-base">Envío Rápido</p>
                <p className="text-xs sm:text-sm text-primary-100 hidden sm:block">En toda la ciudad</p>
              </div>
            </div>
            <div className="flex items-center justify-center md:justify-start space-x-2 sm:space-x-3 text-white">
              <Shield className="h-6 w-6 sm:h-7 sm:w-7 md:h-8 md:w-8 flex-shrink-0" />
              <div>
                <p className="font-semibold text-sm sm:text-base">Calidad Garantizada</p>
                <p className="text-xs sm:text-sm text-primary-100 hidden sm:block">Productos certificados</p>
              </div>
            </div>
            <div className="flex items-center justify-center md:justify-start space-x-2 sm:space-x-3 text-white">
              <CreditCard className="h-6 w-6 sm:h-7 sm:w-7 md:h-8 md:w-8 flex-shrink-0" />
              <div>
                <p className="font-semibold text-sm sm:text-base">Pago Seguro</p>
                <p className="text-xs sm:text-sm text-primary-100 hidden sm:block">Múltiples opciones</p>
              </div>
            </div>
            <div className="flex items-center justify-center md:justify-start space-x-2 sm:space-x-3 text-white">
              <Award className="h-6 w-6 sm:h-7 sm:w-7 md:h-8 md:w-8 flex-shrink-0" />
              <div>
                <p className="font-semibold text-sm sm:text-base">20+ Años</p>
                <p className="text-xs sm:text-sm text-primary-100 hidden sm:block">De experiencia</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      {/* Main Footer Content */}
      <div className="w-full mx-auto px-3 sm:px-4 md:px-6 lg:px-8 xl:px-12 2xl:px-16 py-8 sm:py-12">
        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6 sm:gap-8">
          {/* Company Info */}
          <div className="lg:col-span-2 sm:col-span-2">
            <div className="flex items-center mb-4 sm:mb-6">
              <div className="relative w-10 h-10 sm:w-12 sm:h-12 mr-2 sm:mr-3">
                <Image
                  src="/logo.png"
                  alt="Cielo Carnes"
                  fill
                  className="object-contain"
                />
              </div>
              <div>
                <h3 className="text-lg sm:text-xl font-display font-bold text-white">Cielo Carnes</h3>
                <p className="text-xs text-neutral-400">Tradición y Calidad</p>
              </div>
            </div>
            <p className="text-sm sm:text-base text-neutral-300 mb-4 sm:mb-6 leading-relaxed">
              Más de 20 años siendo el proveedor de confianza de carnes y fiambres premium 
              para las familias bolivianas. Calidad, frescura y servicio excepcional nos distinguen.
            </p>
            
            {/* Social Media */}
            <div className="flex space-x-3 sm:space-x-4">
              <a 
                href="https://facebook.com" 
                target="_blank" 
                rel="noopener noreferrer"
                className="bg-neutral-800 p-2 rounded-lg hover:bg-primary-700 transition-colors group"
              >
                <Facebook className="h-4 w-4 sm:h-5 sm:w-5 text-neutral-400 group-hover:text-white" />
              </a>
              <a 
                href="https://instagram.com" 
                target="_blank" 
                rel="noopener noreferrer"
                className="bg-neutral-800 p-2 rounded-lg hover:bg-primary-700 transition-colors group"
              >
                <Instagram className="h-4 w-4 sm:h-5 sm:w-5 text-neutral-400 group-hover:text-white" />
              </a>
              <a 
                href="https://wa.me/59169420542" 
                target="_blank" 
                rel="noopener noreferrer"
                className="bg-neutral-800 p-2 rounded-lg hover:bg-primary-700 transition-colors group"
              >
                <MessageCircle className="h-4 w-4 sm:h-5 sm:w-5 text-neutral-400 group-hover:text-white" />
              </a>
            </div>
          </div>

          {/* Quick Links */}
          <div>
            <h4 className="text-base sm:text-lg font-semibold text-white mb-3 sm:mb-4">Enlaces Rápidos</h4>
            <ul className="space-y-2 sm:space-y-3">
              <li>
                <Link href="/" className="text-neutral-300 hover:text-secondary-400 transition-colors">
                  Inicio
                </Link>
              </li>
              <li>
                <Link href="/about" className="text-neutral-300 hover:text-secondary-400 transition-colors">
                  Nosotros
                </Link>
              </li>
              <li>
                <Link href="/shop" className="text-neutral-300 hover:text-secondary-400 transition-colors">
                  Tienda
                </Link>
              </li>
              <li>
                <Link href="/recipes-simple" className="text-neutral-300 hover:text-secondary-400 transition-colors">
                  Recetas
                </Link>
              </li>
              <li>
                <Link href="/contact" className="text-neutral-300 hover:text-secondary-400 transition-colors">
                  Contacto
                </Link>
              </li>
            </ul>
          </div>

          {/* Categories */}
          <div>
            <h4 className="text-base sm:text-lg font-semibold text-white mb-3 sm:mb-4">Categorías</h4>
            <ul className="space-y-2 sm:space-y-3">
              <li>
                <Link href="/shop?category=carnes-rojas" className="text-neutral-300 hover:text-secondary-400 transition-colors">
                  Carnes Rojas
                </Link>
              </li>
              <li>
                <Link href="/shop?category=carnes-blancas" className="text-neutral-300 hover:text-secondary-400 transition-colors">
                  Carnes Blancas
                </Link>
              </li>
              <li>
                <Link href="/shop?category=embutidos" className="text-neutral-300 hover:text-secondary-400 transition-colors">
                  Embutidos
                </Link>
              </li>
              <li>
                <Link href="/shop?category=fiambres" className="text-neutral-300 hover:text-secondary-400 transition-colors">
                  Fiambres
                </Link>
              </li>
              <li>
                <Link href="/shop?ofertas=true" className="text-secondary-400 font-semibold hover:text-secondary-300 transition-colors">
                  Ofertas Especiales
                </Link>
              </li>
            </ul>
          </div>

          {/* Contact Info */}
          <div className="sm:col-span-2 lg:col-span-1">
            <h4 className="text-base sm:text-lg font-semibold text-white mb-3 sm:mb-4">Contacto</h4>
            <ul className="space-y-2 sm:space-y-3">
              <li className="flex items-start space-x-3">
                <Phone className="h-5 w-5 text-secondary-400 mt-0.5" />
                <div>
                  <p className="text-neutral-300">+591 69420542</p>
                  <p className="text-sm text-neutral-400">WhatsApp disponible</p>
                </div>
              </li>
              <li className="flex items-start space-x-3">
                <Mail className="h-5 w-5 text-secondary-400 mt-0.5" />
                <div>
                  <p className="text-neutral-300">info@cielocarnes.com</p>
                  <p className="text-sm text-neutral-400">Respuesta en 24h</p>
                </div>
              </li>
              <li className="flex items-start space-x-3">
                <MapPin className="h-5 w-5 text-secondary-400 mt-0.5" />
                <div>
                  <p className="text-neutral-300">Av. Siempre Viva 123</p>
                  <p className="text-sm text-neutral-400">Santa Cruz, Bolivia</p>
                </div>
              </li>
              <li className="flex items-start space-x-3">
                <Clock className="h-5 w-5 text-secondary-400 mt-0.5" />
                <div>
                  <p className="text-neutral-300">Lun-Sáb: 8:00 - 20:00</p>
                  <p className="text-sm text-neutral-400">Dom: 9:00 - 14:00</p>
                </div>
              </li>
            </ul>
          </div>
        </div>

        {/* Newsletter */}
        <div className="mt-8 sm:mt-12 pt-6 sm:pt-8 border-t border-neutral-800">
          <div className="max-w-md mx-auto text-center lg:text-left lg:max-w-none lg:flex lg:items-center lg:justify-between">
            <div className="mb-4 lg:mb-0">
              <h4 className="text-base sm:text-lg font-semibold text-white mb-2">Suscríbete a nuestro boletín</h4>
              <p className="text-sm sm:text-base text-neutral-300">Recibe ofertas exclusivas y recetas especiales</p>
            </div>
            <form className="flex flex-col sm:flex-row gap-2 sm:gap-3 max-w-md mx-auto lg:mx-0">
              <input
                type="email"
                placeholder="Tu correo electrónico"
                className="flex-1 px-3 sm:px-4 py-2 text-sm sm:text-base bg-neutral-800 border border-neutral-700 rounded-lg text-white placeholder-neutral-400 focus:outline-none focus:border-primary-500 focus:ring-1 focus:ring-primary-500"
              />
              <button
                type="submit"
                className="px-4 sm:px-6 py-2 text-sm sm:text-base bg-primary-700 text-white font-semibold rounded-lg hover:bg-primary-600 transition-colors"
              >
                Suscribirse
              </button>
            </form>
          </div>
        </div>

        {/* Bottom Bar */}
        <div className="mt-6 sm:mt-8 pt-6 sm:pt-8 border-t border-neutral-800">
          <div className="flex flex-col md:flex-row justify-between items-center space-y-3 sm:space-y-4 md:space-y-0">
            <p className="text-neutral-400 text-xs sm:text-sm text-center md:text-left">
              &copy; {currentYear} Cielo Carnes. Todos los derechos reservados.
            </p>
            <div className="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-4 md:space-x-6 text-xs sm:text-sm text-center">
              <Link href="/privacy" className="text-neutral-400 hover:text-secondary-400 transition-colors">
                Política de Privacidad
              </Link>
              <Link href="/terms" className="text-neutral-400 hover:text-secondary-400 transition-colors">
                Términos y Condiciones
              </Link>
              <Link href="/faq" className="text-neutral-400 hover:text-secondary-400 transition-colors">
                Preguntas Frecuentes
              </Link>
            </div>
          </div>
        </div>
      </div>
    </footer>
  )
}
