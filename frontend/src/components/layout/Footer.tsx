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
    <footer className="bg-gradient-to-b from-neutral-900 to-neutral-950">
      {/* Features Bar */}
      <div className="bg-primary-700 py-6">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div className="flex items-center justify-center md:justify-start space-x-3 text-white">
              <Truck className="h-8 w-8" />
              <div>
                <p className="font-semibold">Envío Rápido</p>
                <p className="text-sm text-primary-100">En toda la ciudad</p>
              </div>
            </div>
            <div className="flex items-center justify-center md:justify-start space-x-3 text-white">
              <Shield className="h-8 w-8" />
              <div>
                <p className="font-semibold">Calidad Garantizada</p>
                <p className="text-sm text-primary-100">Productos certificados</p>
              </div>
            </div>
            <div className="flex items-center justify-center md:justify-start space-x-3 text-white">
              <CreditCard className="h-8 w-8" />
              <div>
                <p className="font-semibold">Pago Seguro</p>
                <p className="text-sm text-primary-100">Múltiples opciones</p>
              </div>
            </div>
            <div className="flex items-center justify-center md:justify-start space-x-3 text-white">
              <Award className="h-8 w-8" />
              <div>
                <p className="font-semibold">20+ Años</p>
                <p className="text-sm text-primary-100">De experiencia</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      {/* Main Footer Content */}
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8">
          {/* Company Info */}
          <div className="lg:col-span-2">
            <div className="flex items-center mb-6">
              <div className="relative w-12 h-12 mr-3">
                <Image
                  src="/logo.png"
                  alt="Cielo Carnes"
                  fill
                  className="object-contain"
                />
              </div>
              <div>
                <h3 className="text-xl font-display font-bold text-white">Cielo Carnes</h3>
                <p className="text-xs text-neutral-400">Tradición y Calidad</p>
              </div>
            </div>
            <p className="text-neutral-300 mb-6 leading-relaxed">
              Más de 20 años siendo el proveedor de confianza de carnes y fiambres premium 
              para las familias bolivianas. Calidad, frescura y servicio excepcional nos distinguen.
            </p>
            
            {/* Social Media */}
            <div className="flex space-x-4">
              <a 
                href="https://facebook.com" 
                target="_blank" 
                rel="noopener noreferrer"
                className="bg-neutral-800 p-2 rounded-lg hover:bg-primary-700 transition-colors group"
              >
                <Facebook className="h-5 w-5 text-neutral-400 group-hover:text-white" />
              </a>
              <a 
                href="https://instagram.com" 
                target="_blank" 
                rel="noopener noreferrer"
                className="bg-neutral-800 p-2 rounded-lg hover:bg-primary-700 transition-colors group"
              >
                <Instagram className="h-5 w-5 text-neutral-400 group-hover:text-white" />
              </a>
              <a 
                href="https://wa.me/59170123456" 
                target="_blank" 
                rel="noopener noreferrer"
                className="bg-neutral-800 p-2 rounded-lg hover:bg-primary-700 transition-colors group"
              >
                <MessageCircle className="h-5 w-5 text-neutral-400 group-hover:text-white" />
              </a>
            </div>
          </div>

          {/* Quick Links */}
          <div>
            <h4 className="text-lg font-semibold text-white mb-4">Enlaces Rápidos</h4>
            <ul className="space-y-3">
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
            <h4 className="text-lg font-semibold text-white mb-4">Categorías</h4>
            <ul className="space-y-3">
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
          <div>
            <h4 className="text-lg font-semibold text-white mb-4">Contacto</h4>
            <ul className="space-y-3">
              <li className="flex items-start space-x-3">
                <Phone className="h-5 w-5 text-secondary-400 mt-0.5" />
                <div>
                  <p className="text-neutral-300">+591 70123456</p>
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
        <div className="mt-12 pt-8 border-t border-neutral-800">
          <div className="max-w-md mx-auto text-center lg:text-left lg:max-w-none lg:flex lg:items-center lg:justify-between">
            <div className="mb-4 lg:mb-0">
              <h4 className="text-lg font-semibold text-white mb-2">Suscríbete a nuestro boletín</h4>
              <p className="text-neutral-300">Recibe ofertas exclusivas y recetas especiales</p>
            </div>
            <form className="flex flex-col sm:flex-row gap-3 max-w-md mx-auto lg:mx-0">
              <input
                type="email"
                placeholder="Tu correo electrónico"
                className="flex-1 px-4 py-2 bg-neutral-800 border border-neutral-700 rounded-lg text-white placeholder-neutral-400 focus:outline-none focus:border-primary-500 focus:ring-1 focus:ring-primary-500"
              />
              <button
                type="submit"
                className="px-6 py-2 bg-primary-700 text-white font-semibold rounded-lg hover:bg-primary-600 transition-colors"
              >
                Suscribirse
              </button>
            </form>
          </div>
        </div>

        {/* Bottom Bar */}
        <div className="mt-8 pt-8 border-t border-neutral-800">
          <div className="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
            <p className="text-neutral-400 text-sm">
              &copy; {currentYear} Cielo Carnes. Todos los derechos reservados.
            </p>
            <div className="flex space-x-6 text-sm">
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
