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
