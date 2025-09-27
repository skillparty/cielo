import Link from 'next/link'
import { CheckCircleIcon, HeartIcon, ShieldCheckIcon, TruckIcon } from '@heroicons/react/24/outline'
import Button from '@/components/ui/Button'

const features = [
  {
    icon: ShieldCheckIcon,
    title: 'Calidad Garantizada',
    description: 'Todos nuestros productos pasan por estrictos controles de calidad para asegurar la frescura y sabor.'
  },
  {
    icon: HeartIcon,
    title: 'Tradición Familiar',
    description: 'Más de 20 años de experiencia familiar en la selección y preparación de carnes premium.'
  },
  {
    icon: TruckIcon,
    title: 'Entrega Fresca',
    description: 'Sistema de cadena de frío que mantiene la frescura desde nuestras instalaciones hasta tu mesa.'
  },
  {
    icon: CheckCircleIcon,
    title: 'Productos Selectos',
    description: 'Cuidadosa selección de los mejores cortes y productos cárnicos del mercado local.'
  }
]

export default function AboutSection() {
  return (
    <section className="py-16 bg-gray-50">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
          {/* Content */}
          <div>
            <div className="mb-6">
              <span className="text-red-600 font-semibold text-sm uppercase tracking-wide">
                Nuestra Historia
              </span>
              <h2 className="text-3xl md:text-4xl font-bold text-gray-900 mt-2 mb-4">
                Tradición y Calidad desde 2003
              </h2>
              <p className="text-lg text-gray-600 leading-relaxed">
                En Cielo Carnes, nos enorgullecemos de ser una empresa familiar boliviana 
                dedicada a ofrecer los mejores productos cárnicos. Nuestra pasión por la 
                calidad y el servicio excepcional nos ha convertido en la elección preferida 
                de familias y restaurantes en toda La Paz.
              </p>
            </div>

            <div className="mb-8">
              <h3 className="text-xl font-semibold text-gray-900 mb-4">
                ¿Por qué elegir Cielo Carnes?
              </h3>
              <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
                {features.map((feature, index) => (
                  <div key={index} className="flex items-start">
                    <feature.icon className="h-6 w-6 text-red-600 mr-3 mt-1 flex-shrink-0" />
                    <div>
                      <h4 className="font-medium text-gray-900 mb-1">
                        {feature.title}
                      </h4>
                      <p className="text-sm text-gray-600">
                        {feature.description}
                      </p>
                    </div>
                  </div>
                ))}
              </div>
            </div>

            <div className="flex flex-col sm:flex-row gap-4">
              <Button size="lg" asChild>
                <Link href="/about">
                  Conoce Más Sobre Nosotros
                </Link>
              </Button>
              <Button variant="outline" size="lg" asChild>
                <Link href="/contact">
                  Contáctanos
                </Link>
              </Button>
            </div>
          </div>

          {/* Image/Visual */}
          <div className="relative">
            {/* Main Image Placeholder */}
            <div className="relative bg-gradient-to-br from-red-100 to-red-200 rounded-2xl p-8 shadow-lg">
              <div className="aspect-square bg-white rounded-xl shadow-inner flex items-center justify-center">
                <div className="text-center">
                  <div className="text-6xl mb-4">🏪</div>
                  <h3 className="text-xl font-bold text-red-800 mb-2">
                    Nuestra Tienda
                  </h3>
                  <p className="text-red-600">
                    Visítanos en La Paz
                  </p>
                </div>
              </div>
            </div>

            {/* Floating Stats */}
            <div className="absolute -top-4 -right-4 bg-white rounded-lg shadow-lg p-4 border-l-4 border-red-600">
              <div className="text-2xl font-bold text-red-600">20+</div>
              <div className="text-sm text-gray-600">Años</div>
            </div>

            <div className="absolute -bottom-4 -left-4 bg-white rounded-lg shadow-lg p-4 border-l-4 border-green-500">
              <div className="text-2xl font-bold text-green-600">1000+</div>
              <div className="text-sm text-gray-600">Clientes</div>
            </div>

            {/* Decorative Elements */}
            <div className="absolute top-1/2 -left-8 w-16 h-16 bg-yellow-300 rounded-full opacity-20"></div>
            <div className="absolute bottom-1/4 -right-8 w-12 h-12 bg-blue-300 rounded-full opacity-20"></div>
          </div>
        </div>
      </div>
    </section>
  )
}
