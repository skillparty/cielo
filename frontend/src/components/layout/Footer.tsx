import Link from 'next/link'
import { EnvelopeIcon, PhoneIcon, MapPinIcon } from '@heroicons/react/24/outline'

const footerLinks = {
  company: [
    { name: 'Nosotros', href: '/about' },
    { name: 'Nuestra Historia', href: '/about#historia' },
    { name: 'Calidad', href: '/about#calidad' },
    { name: 'Ubicación', href: '/contact#ubicacion' },
  ],
  products: [
    { name: 'Carnes Frescas', href: '/shop?category=carnes' },
    { name: 'Fiambres', href: '/shop?category=fiambres' },
    { name: 'Embutidos', href: '/shop?category=embutidos' },
    { name: 'Especiales', href: '/shop?featured=true' },
  ],
  support: [
    { name: 'Contacto', href: '/contact' },
    { name: 'Preguntas Frecuentes', href: '/faq' },
    { name: 'Políticas de Envío', href: '/shipping' },
    { name: 'Términos y Condiciones', href: '/terms' },
  ],
}

export default function Footer() {
  return (
    <footer className="bg-gray-900 text-white">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
          {/* Company Info */}
          <div className="lg:col-span-2">
            <div className="flex items-center mb-4">
              <div className="h-10 w-10 bg-red-600 rounded-lg flex items-center justify-center">
                <span className="text-white font-bold text-lg">C</span>
              </div>
              <span className="ml-2 text-xl font-bold">Cielo Carnes</span>
            </div>
            <p className="text-gray-300 mb-6 max-w-md">
              Especialistas en carnes y fiambres de cerdo de la más alta calidad. 
              Tradición familiar desde hace más de 20 años, comprometidos con la 
              excelencia y frescura en cada producto.
            </p>
            
            {/* Contact Info */}
            <div className="space-y-3">
              <div className="flex items-center text-sm text-gray-300">
                <EnvelopeIcon className="h-5 w-5 mr-3 text-red-400" />
                <span>info@cielocarnes.com</span>
              </div>
              <div className="flex items-center text-sm text-gray-300">
                <PhoneIcon className="h-5 w-5 mr-3 text-red-400" />
                <span>+591 2 123-4567</span>
              </div>
              <div className="flex items-center text-sm text-gray-300">
                <MapPinIcon className="h-5 w-5 mr-3 text-red-400" />
                <span>Av. Principal 123, La Paz, Bolivia</span>
              </div>
            </div>
          </div>

          {/* Products */}
          <div>
            <h3 className="text-lg font-semibold mb-4">Productos</h3>
            <ul className="space-y-2">
              {footerLinks.products.map((link) => (
                <li key={link.name}>
                  <Link
                    href={link.href}
                    className="text-sm text-gray-300 hover:text-white transition-colors"
                  >
                    {link.name}
                  </Link>
                </li>
              ))}
            </ul>
          </div>

          {/* Support */}
          <div>
            <h3 className="text-lg font-semibold mb-4">Soporte</h3>
            <ul className="space-y-2">
              {footerLinks.support.map((link) => (
                <li key={link.name}>
                  <Link
                    href={link.href}
                    className="text-sm text-gray-300 hover:text-white transition-colors"
                  >
                    {link.name}
                  </Link>
                </li>
              ))}
            </ul>
          </div>
        </div>

        {/* Bottom Section */}
        <div className="border-t border-gray-800 mt-8 pt-8">
          <div className="flex flex-col md:flex-row justify-between items-center">
            <p className="text-sm text-gray-400">
              © {new Date().getFullYear()} Cielo Carnes. Todos los derechos reservados.
            </p>
            <div className="flex space-x-6 mt-4 md:mt-0">
              <Link href="/privacy" className="text-sm text-gray-400 hover:text-white transition-colors">
                Privacidad
              </Link>
              <Link href="/terms" className="text-sm text-gray-400 hover:text-white transition-colors">
                Términos
              </Link>
              <Link href="/cookies" className="text-sm text-gray-400 hover:text-white transition-colors">
                Cookies
              </Link>
            </div>
          </div>
          <p className="text-xs text-gray-500 mt-4 text-center md:text-left">
            Desarrollado con Next.js, React y Tailwind CSS
          </p>
        </div>
      </div>
    </footer>
  )
}
