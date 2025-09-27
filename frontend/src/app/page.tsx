import Layout from '@/components/layout/Layout'
import Link from 'next/link'
import Image from 'next/image'
import { 
  ChevronRight, 
  Star, 
  TrendingUp, 
  Users, 
  Award,
  Clock,
  Truck,
  Shield,
  Phone
} from 'lucide-react'

export default function Home() {
  return (
    <Layout>
      {/* Hero Section */}
      <section className="relative h-[600px] bg-gradient-to-r from-primary-900 to-primary-700 overflow-hidden">
        <div className="absolute inset-0 bg-black opacity-40"></div>
        <div className="absolute inset-0 bg-gradient-hero"></div>
        
        <div className="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center">
          <div className="max-w-2xl">
            <h1 className="text-5xl md:text-6xl font-display font-bold text-white mb-6 animate-fade-in">
              Carnes Premium para tu Mesa
            </h1>
            <p className="text-xl text-neutral-100 mb-8 animate-slide-up">
              Más de 20 años ofreciendo la mejor selección de carnes frescas y fiambres 
              de calidad superior. Tradición familiar boliviana en cada corte.
            </p>
            <div className="flex flex-col sm:flex-row gap-4 animate-slide-up">
              <Link
                href="/shop"
                className="inline-flex items-center justify-center px-8 py-3 bg-secondary-500 text-white font-semibold rounded-lg hover:bg-secondary-600 transition-all transform hover:scale-105 shadow-strong"
              >
                Ver Productos
                <ChevronRight className="ml-2 h-5 w-5" />
              </Link>
              <Link
                href="/about"
                className="inline-flex items-center justify-center px-8 py-3 bg-white text-primary-700 font-semibold rounded-lg hover:bg-neutral-100 transition-all transform hover:scale-105 shadow-strong"
              >
                Conoce Nuestra Historia
              </Link>
            </div>
          </div>
        </div>

        {/* Decorative Element */}
        <div className="absolute bottom-0 left-0 right-0">
          <svg className="w-full h-24 text-white" viewBox="0 0 1440 120" fill="currentColor">
            <path d="M0,64L48,69.3C96,75,192,85,288,80C384,75,480,53,576,48C672,43,768,53,864,58.7C960,64,1056,64,1152,58.7C1248,53,1344,43,1392,37.3L1440,32L1440,120L1392,120C1344,120,1248,120,1152,120C1056,120,960,120,864,120C768,120,672,120,576,120C480,120,384,120,288,120C192,120,96,120,48,120L0,120Z"></path>
          </svg>
        </div>
      </section>

      {/* Features Bar */}
      <section className="bg-white py-12 -mt-1">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div className="text-center group">
              <div className="bg-primary-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-primary-200 transition-colors">
                <Truck className="h-8 w-8 text-primary-700" />
              </div>
              <h3 className="font-semibold text-neutral-900 mb-2">Envío Rápido</h3>
              <p className="text-sm text-neutral-600">Entrega el mismo día en pedidos antes de las 2PM</p>
            </div>
            <div className="text-center group">
              <div className="bg-primary-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-primary-200 transition-colors">
                <Shield className="h-8 w-8 text-primary-700" />
              </div>
              <h3 className="font-semibold text-neutral-900 mb-2">Calidad Certificada</h3>
              <p className="text-sm text-neutral-600">Productos con los más altos estándares de calidad</p>
            </div>
            <div className="text-center group">
              <div className="bg-primary-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-primary-200 transition-colors">
                <Users className="h-8 w-8 text-primary-700" />
              </div>
              <h3 className="font-semibold text-neutral-900 mb-2">Atención Personalizada</h3>
              <p className="text-sm text-neutral-600">Asesoramiento experto para cada cliente</p>
            </div>
            <div className="text-center group">
              <div className="bg-primary-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-primary-200 transition-colors">
                <Award className="h-8 w-8 text-primary-700" />
              </div>
              <h3 className="font-semibold text-neutral-900 mb-2">20+ Años</h3>
              <p className="text-sm text-neutral-600">De experiencia en el mercado boliviano</p>
            </div>
          </div>
        </div>
      </section>

      {/* Featured Products */}
      <section className="bg-neutral-50 py-16">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="text-center mb-12">
            <h2 className="text-4xl font-display font-bold text-neutral-900 mb-4">
              Productos Destacados
            </h2>
            <p className="text-xl text-neutral-600 max-w-2xl mx-auto">
              Descubre nuestra selección premium de carnes frescas y productos especiales
            </p>
          </div>

          <div className="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
            {/* Product Card 1 */}
            <div className="bg-white rounded-xl shadow-medium hover:shadow-strong transition-all transform hover:-translate-y-1">
              <div className="relative h-48 bg-gradient-to-br from-neutral-100 to-neutral-200 rounded-t-xl">
                <div className="absolute top-4 right-4 bg-secondary-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                  Bestseller
                </div>
              </div>
              <div className="p-6">
                <h3 className="text-xl font-semibold text-neutral-900 mb-2">Lomo Premium</h3>
                <p className="text-neutral-600 mb-4">Corte tierno y jugoso, perfecto para ocasiones especiales</p>
                <div className="flex items-center justify-between">
                  <span className="text-2xl font-bold text-primary-700">Bs. 85</span>
                  <Link
                    href="/shop"
                    className="bg-primary-700 text-white px-4 py-2 rounded-lg hover:bg-primary-600 transition-colors"
                  >
                    Ver Más
                  </Link>
                </div>
              </div>
            </div>

            {/* Product Card 2 */}
            <div className="bg-white rounded-xl shadow-medium hover:shadow-strong transition-all transform hover:-translate-y-1">
              <div className="relative h-48 bg-gradient-to-br from-neutral-100 to-neutral-200 rounded-t-xl">
                <div className="absolute top-4 right-4 bg-primary-700 text-white px-3 py-1 rounded-full text-sm font-semibold">
                  Nuevo
                </div>
              </div>
              <div className="p-6">
                <h3 className="text-xl font-semibold text-neutral-900 mb-2">Chorizo Artesanal</h3>
                <p className="text-neutral-600 mb-4">Elaborado con receta tradicional y especias selectas</p>
                <div className="flex items-center justify-between">
                  <span className="text-2xl font-bold text-primary-700">Bs. 45</span>
                  <Link
                    href="/shop"
                    className="bg-primary-700 text-white px-4 py-2 rounded-lg hover:bg-primary-600 transition-colors"
                  >
                    Ver Más
                  </Link>
                </div>
              </div>
            </div>

            {/* Product Card 3 */}
            <div className="bg-white rounded-xl shadow-medium hover:shadow-strong transition-all transform hover:-translate-y-1">
              <div className="relative h-48 bg-gradient-to-br from-neutral-100 to-neutral-200 rounded-t-xl">
                <div className="absolute top-4 right-4 bg-success text-white px-3 py-1 rounded-full text-sm font-semibold">
                  Oferta
                </div>
              </div>
              <div className="p-6">
                <h3 className="text-xl font-semibold text-neutral-900 mb-2">Pack Parrillero</h3>
                <p className="text-neutral-600 mb-4">Selección especial para tu asado perfecto</p>
                <div className="flex items-center justify-between">
                  <div>
                    <span className="text-2xl font-bold text-primary-700">Bs. 120</span>
                    <span className="text-sm text-neutral-500 line-through ml-2">Bs. 150</span>
                  </div>
                  <Link
                    href="/shop"
                    className="bg-primary-700 text-white px-4 py-2 rounded-lg hover:bg-primary-600 transition-colors"
                  >
                    Ver Más
                  </Link>
                </div>
              </div>
            </div>
          </div>

          <div className="text-center">
            <Link
              href="/shop"
              className="inline-flex items-center justify-center px-8 py-3 bg-secondary-500 text-white font-semibold rounded-lg hover:bg-secondary-600 transition-all transform hover:scale-105"
            >
              Ver Todos los Productos
              <ChevronRight className="ml-2 h-5 w-5" />
            </Link>
          </div>
        </div>
      </section>

      {/* About Section */}
      <section className="bg-white py-16">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
              <h2 className="text-4xl font-display font-bold text-neutral-900 mb-6">
                Tradición Familiar desde 2003
              </h2>
              <p className="text-lg text-neutral-600 mb-6 leading-relaxed">
                En Cielo Carnes, llevamos más de dos décadas siendo el proveedor de confianza 
                para las familias bolivianas. Nuestra pasión por la calidad y el servicio 
                excepcional nos ha convertido en líderes del sector.
              </p>
              <div className="space-y-4 mb-8">
                <div className="flex items-start space-x-3">
                  <div className="bg-primary-100 rounded-full p-1">
                    <Star className="h-5 w-5 text-primary-700" />
                  </div>
                  <div>
                    <h4 className="font-semibold text-neutral-900">Calidad Premium</h4>
                    <p className="text-neutral-600">Seleccionamos solo los mejores cortes y productos</p>
                  </div>
                </div>
                <div className="flex items-start space-x-3">
                  <div className="bg-primary-100 rounded-full p-1">
                    <TrendingUp className="h-5 w-5 text-primary-700" />
                  </div>
                  <div>
                    <h4 className="font-semibold text-neutral-900">Crecimiento Constante</h4>
                    <p className="text-neutral-600">Innovando y mejorando nuestros servicios continuamente</p>
                  </div>
                </div>
                <div className="flex items-start space-x-3">
                  <div className="bg-primary-100 rounded-full p-1">
                    <Users className="h-5 w-5 text-primary-700" />
                  </div>
                  <div>
                    <h4 className="font-semibold text-neutral-900">Equipo Experto</h4>
                    <p className="text-neutral-600">Personal capacitado para brindarte el mejor servicio</p>
                  </div>
                </div>
              </div>
              <Link
                href="/about"
                className="inline-flex items-center justify-center px-6 py-3 bg-primary-700 text-white font-semibold rounded-lg hover:bg-primary-600 transition-all"
              >
                Conoce Más Sobre Nosotros
                <ChevronRight className="ml-2 h-5 w-5" />
              </Link>
            </div>
            <div className="relative">
              <div className="bg-gradient-to-br from-primary-100 to-secondary-100 rounded-2xl h-96 flex items-center justify-center">
                <div className="text-center">
                  <div className="text-6xl font-bold text-primary-700 mb-2">20+</div>
                  <div className="text-xl text-neutral-700">Años de Experiencia</div>
                </div>
              </div>
              <div className="absolute -bottom-6 -right-6 bg-secondary-500 text-white rounded-xl p-6 shadow-strong">
                <div className="text-3xl font-bold">5000+</div>
                <div className="text-sm">Clientes Satisfechos</div>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* Testimonials */}
      <section className="bg-gradient-to-br from-primary-50 to-secondary-50 py-16">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="text-center mb-12">
            <h2 className="text-4xl font-display font-bold text-neutral-900 mb-4">
              Lo que Dicen Nuestros Clientes
            </h2>
            <p className="text-xl text-neutral-600">
              La satisfacción de nuestros clientes es nuestra mejor carta de presentación
            </p>
          </div>

          <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
            {/* Testimonial 1 */}
            <div className="bg-white rounded-xl p-6 shadow-soft">
              <div className="flex mb-4">
                {[...Array(5)].map((_, i) => (
                  <Star key={i} className="h-5 w-5 text-secondary-500 fill-current" />
                ))}
              </div>
              <p className="text-neutral-600 mb-4 italic">
                "La mejor calidad en carnes de Santa Cruz. Siempre frescos y con excelente atención. 
                Son mi primera opción desde hace años."
              </p>
              <div className="flex items-center">
                <div className="bg-primary-100 rounded-full w-12 h-12 flex items-center justify-center mr-3">
                  <span className="text-primary-700 font-semibold">MR</span>
                </div>
                <div>
                  <p className="font-semibold text-neutral-900">María Rodríguez</p>
                  <p className="text-sm text-neutral-500">Cliente frecuente</p>
                </div>
              </div>
            </div>

            {/* Testimonial 2 */}
            <div className="bg-white rounded-xl p-6 shadow-soft">
              <div className="flex mb-4">
                {[...Array(5)].map((_, i) => (
                  <Star key={i} className="h-5 w-5 text-secondary-500 fill-current" />
                ))}
              </div>
              <p className="text-neutral-600 mb-4 italic">
                "Excelente servicio y productos de primera. El personal siempre está dispuesto 
                a asesorar sobre los mejores cortes."
              </p>
              <div className="flex items-center">
                <div className="bg-primary-100 rounded-full w-12 h-12 flex items-center justify-center mr-3">
                  <span className="text-primary-700 font-semibold">JG</span>
                </div>
                <div>
                  <p className="font-semibold text-neutral-900">Juan García</p>
                  <p className="text-sm text-neutral-500">Chef profesional</p>
                </div>
              </div>
            </div>

            {/* Testimonial 3 */}
            <div className="bg-white rounded-xl p-6 shadow-soft">
              <div className="flex mb-4">
                {[...Array(5)].map((_, i) => (
                  <Star key={i} className="h-5 w-5 text-secondary-500 fill-current" />
                ))}
              </div>
              <p className="text-neutral-600 mb-4 italic">
                "Los embutidos artesanales son espectaculares. Se nota la calidad y el cuidado 
                en cada producto. 100% recomendado."
              </p>
              <div className="flex items-center">
                <div className="bg-primary-100 rounded-full w-12 h-12 flex items-center justify-center mr-3">
                  <span className="text-primary-700 font-semibold">AF</span>
                </div>
                <div>
                  <p className="font-semibold text-neutral-900">Ana Fernández</p>
                  <p className="text-sm text-neutral-500">Amante de la buena cocina</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* CTA Section */}
      <section className="bg-gradient-to-r from-primary-700 to-primary-900 py-16">
        <div className="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
          <h2 className="text-4xl font-display font-bold text-white mb-6">
            ¿Listo para Disfrutar de la Mejor Calidad?
          </h2>
          <p className="text-xl text-primary-100 mb-8">
            Visítanos en nuestra tienda o realiza tu pedido por WhatsApp. 
            Entrega a domicilio disponible en toda la ciudad.
          </p>
          <div className="flex flex-col sm:flex-row gap-4 justify-center">
            <Link
              href="/shop"
              className="inline-flex items-center justify-center px-8 py-3 bg-secondary-500 text-white font-semibold rounded-lg hover:bg-secondary-600 transition-all transform hover:scale-105 shadow-strong"
            >
              Comprar Ahora
              <ChevronRight className="ml-2 h-5 w-5" />
            </Link>
            <a
              href="https://wa.me/59170123456"
              target="_blank"
              rel="noopener noreferrer"
              className="inline-flex items-center justify-center px-8 py-3 bg-white text-primary-700 font-semibold rounded-lg hover:bg-neutral-100 transition-all transform hover:scale-105 shadow-strong"
            >
              <Phone className="mr-2 h-5 w-5" />
              Contactar por WhatsApp
            </a>
          </div>
        </div>
      </section>
    </Layout>
  )
}
