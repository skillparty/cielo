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
  Phone,
  MapPin
} from 'lucide-react'

export default function Home() {
  return (
    <Layout>
      {/* Hero Section */}
      <section className="relative h-[500px] sm:h-[600px] lg:h-[700px] overflow-hidden w-full">
        {/* Background Image */}
        <div className="absolute inset-0">
          <Image
            src="/imgUno.png"
            alt="Carnes Premium Cielo Carnes"
            fill
            className="object-cover object-center"
            priority
          />
          <div className="absolute inset-0 bg-gradient-to-r from-black/70 via-black/50 to-black/30"></div>
        </div>
        
        <div className="relative w-full mx-auto px-3 sm:px-4 md:px-6 lg:px-8 xl:px-12 2xl:px-16 h-full flex items-center">
          <div className="max-w-2xl">
            <h1 className="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-display font-bold text-white mb-4 sm:mb-6 animate-fade-in leading-tight drop-shadow-lg">
              Carnes Premium para tu Mesa
            </h1>
            <p className="text-base sm:text-lg md:text-xl text-neutral-100 mb-6 sm:mb-8 animate-slide-up leading-relaxed drop-shadow-md">
              Más de 20 años ofreciendo la mejor selección de carnes frescas y fiambres 
              de calidad superior. Tradición familiar boliviana en cada corte.
            </p>
            <div className="flex flex-col sm:flex-row gap-3 sm:gap-4 animate-slide-up">
              <Link
                href="/shop"
                className="inline-flex items-center justify-center px-6 sm:px-8 py-2.5 sm:py-3 bg-secondary-500 text-white font-semibold rounded-lg hover:bg-secondary-600 transition-all transform hover:scale-105 shadow-strong text-sm sm:text-base"
              >
                Ver Productos
                <ChevronRight className="ml-2 h-4 w-4 sm:h-5 sm:w-5" />
              </Link>
              <Link
                href="/about"
                className="inline-flex items-center justify-center px-6 sm:px-8 py-2.5 sm:py-3 bg-white text-primary-700 font-semibold rounded-lg hover:bg-neutral-100 transition-all transform hover:scale-105 shadow-strong text-sm sm:text-base"
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
      <section className="bg-white py-8 sm:py-12 -mt-1 w-full">
        <div className="w-full mx-auto px-3 sm:px-4 md:px-6 lg:px-8 xl:px-12 2xl:px-16">
          <div className="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6 md:gap-8">
            <div className="text-center group">
              <div className="bg-primary-100 w-12 h-12 sm:w-14 sm:h-14 md:w-16 md:h-16 rounded-full flex items-center justify-center mx-auto mb-3 sm:mb-4 group-hover:bg-primary-200 transition-colors">
                <Truck className="h-6 w-6 sm:h-7 sm:w-7 md:h-8 md:w-8 text-primary-700" />
              </div>
              <h3 className="font-semibold text-neutral-900 mb-1 sm:mb-2 text-sm sm:text-base">Envío Rápido</h3>
              <p className="text-xs sm:text-sm text-neutral-600 leading-tight">Entrega el mismo día en pedidos antes de las 2PM</p>
            </div>
            <div className="text-center group">
              <div className="bg-primary-100 w-12 h-12 sm:w-14 sm:h-14 md:w-16 md:h-16 rounded-full flex items-center justify-center mx-auto mb-3 sm:mb-4 group-hover:bg-primary-200 transition-colors">
                <Shield className="h-6 w-6 sm:h-7 sm:w-7 md:h-8 md:w-8 text-primary-700" />
              </div>
              <h3 className="font-semibold text-neutral-900 mb-1 sm:mb-2 text-sm sm:text-base">Calidad Certificada</h3>
              <p className="text-xs sm:text-sm text-neutral-600 leading-tight">Productos con los más altos estándares de calidad</p>
            </div>
            <div className="text-center group">
              <div className="bg-primary-100 w-12 h-12 sm:w-14 sm:h-14 md:w-16 md:h-16 rounded-full flex items-center justify-center mx-auto mb-3 sm:mb-4 group-hover:bg-primary-200 transition-colors">
                <Users className="h-6 w-6 sm:h-7 sm:w-7 md:h-8 md:w-8 text-primary-700" />
              </div>
              <h3 className="font-semibold text-neutral-900 mb-1 sm:mb-2 text-sm sm:text-base">Atención Personalizada</h3>
              <p className="text-xs sm:text-sm text-neutral-600 leading-tight">Asesoramiento experto para cada cliente</p>
            </div>
            <div className="text-center group">
              <div className="bg-primary-100 w-12 h-12 sm:w-14 sm:h-14 md:w-16 md:h-16 rounded-full flex items-center justify-center mx-auto mb-3 sm:mb-4 group-hover:bg-primary-200 transition-colors">
                <Award className="h-6 w-6 sm:h-7 sm:w-7 md:h-8 md:w-8 text-primary-700" />
              </div>
              <h3 className="font-semibold text-neutral-900 mb-1 sm:mb-2 text-sm sm:text-base">20+ Años</h3>
              <p className="text-xs sm:text-sm text-neutral-600 leading-tight">De experiencia en el mercado boliviano</p>
            </div>
          </div>
        </div>
      </section>

      {/* Featured Products */}
      <section className="bg-neutral-50 py-12 sm:py-16 w-full">
        <div className="w-full mx-auto px-3 sm:px-4 md:px-6 lg:px-8 xl:px-12 2xl:px-16">
          <div className="text-center mb-8 sm:mb-12">
            <h2 className="text-2xl sm:text-3xl md:text-4xl font-display font-bold text-neutral-900 mb-3 sm:mb-4">
              Productos Destacados
            </h2>
            <p className="text-base sm:text-lg md:text-xl text-neutral-600 max-w-2xl mx-auto px-4">
              Descubre nuestra selección premium de carnes frescas y productos especiales
            </p>
          </div>

          <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 md:gap-8 mb-8 sm:mb-12">
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
              className="inline-flex items-center justify-center px-6 sm:px-8 py-2.5 sm:py-3 bg-secondary-500 text-white font-semibold rounded-lg hover:bg-secondary-600 transition-all transform hover:scale-105 text-sm sm:text-base"
            >
              Ver Todos los Productos
              <ChevronRight className="ml-2 h-4 w-4 sm:h-5 sm:w-5" />
            </Link>
          </div>
        </div>
      </section>

      {/* About Section */}
      <section className="bg-white py-12 sm:py-16 w-full">
        <div className="w-full mx-auto px-3 sm:px-4 md:px-6 lg:px-8 xl:px-12 2xl:px-16">
          <div className="grid grid-cols-1 lg:grid-cols-2 gap-8 sm:gap-12 items-center">
            <div>
              <h2 className="text-2xl sm:text-3xl md:text-4xl font-display font-bold text-neutral-900 mb-4 sm:mb-6">
                Tradición Familiar desde 2003
              </h2>
              <p className="text-base sm:text-lg text-neutral-600 mb-4 sm:mb-6 leading-relaxed">
                En Cielo Carnes, llevamos más de dos décadas siendo el proveedor de confianza 
                para las familias bolivianas. Nuestra pasión por la calidad y el servicio 
                excepcional nos ha convertido en líderes del sector.
              </p>
              <div className="space-y-3 sm:space-y-4 mb-6 sm:mb-8">
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
                className="inline-flex items-center justify-center px-5 sm:px-6 py-2.5 sm:py-3 bg-primary-700 text-white font-semibold rounded-lg hover:bg-primary-600 transition-all text-sm sm:text-base"
              >
                Conoce Más Sobre Nosotros
                <ChevronRight className="ml-2 h-4 w-4 sm:h-5 sm:w-5" />
              </Link>
            </div>
            <div className="relative mt-8 lg:mt-0">
              <div className="bg-gradient-to-br from-primary-100 to-secondary-100 rounded-2xl h-64 sm:h-80 md:h-96 flex items-center justify-center">
                <div className="text-center">
                  <div className="text-4xl sm:text-5xl md:text-6xl font-bold text-primary-700 mb-2">20+</div>
                  <div className="text-base sm:text-lg md:text-xl text-neutral-700">Años de Experiencia</div>
                </div>
              </div>
              <div className="absolute -bottom-4 -right-4 sm:-bottom-6 sm:-right-6 bg-secondary-500 text-white rounded-xl p-4 sm:p-6 shadow-strong">
                <div className="text-2xl sm:text-3xl font-bold">5000+</div>
                <div className="text-xs sm:text-sm">Clientes Satisfechos</div>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* Testimonials */}
      <section className="bg-gradient-to-br from-primary-50 to-secondary-50 py-12 sm:py-16 w-full">
        <div className="w-full mx-auto px-3 sm:px-4 md:px-6 lg:px-8 xl:px-12 2xl:px-16">
          <div className="text-center mb-8 sm:mb-12">
            <h2 className="text-2xl sm:text-3xl md:text-4xl font-display font-bold text-neutral-900 mb-3 sm:mb-4">
              Lo que Dicen Nuestros Clientes
            </h2>
            <p className="text-base sm:text-lg md:text-xl text-neutral-600 px-4">
              La satisfacción de nuestros clientes es nuestra mejor carta de presentación
            </p>
          </div>

          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 md:gap-8">
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

      {/* Nuestras Sucursales */}
      <section className="bg-white py-12 sm:py-16 w-full">
        <div className="w-full mx-auto px-3 sm:px-4 md:px-6 lg:px-8 xl:px-12 2xl:px-16">
          <div className="text-center mb-8 sm:mb-12">
            <h2 className="text-2xl sm:text-3xl md:text-4xl font-display font-bold text-neutral-900 mb-3 sm:mb-4">
              Nuestras Sucursales
            </h2>
            <p className="text-base sm:text-lg md:text-xl text-neutral-600 max-w-2xl mx-auto px-4">
              Visítanos en cualquiera de nuestras 3 sucursales estratégicamente ubicadas en La Paz
            </p>
          </div>

          <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 md:gap-8 mb-8 sm:mb-12">
            {/* Sucursal 1: 6 de Agosto */}
            <div className="group bg-white rounded-xl shadow-soft hover:shadow-strong transition-all duration-300 overflow-hidden">
              <div className="relative h-48 sm:h-56">
                <Image
                  src="/ubiUno.jpg"
                  alt="Sucursal 6 de Agosto"
                  fill
                  className="object-cover group-hover:scale-105 transition-transform duration-300"
                />
                <div className="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                <div className="absolute bottom-4 left-4 right-4">
                  <h3 className="text-white font-semibold text-lg mb-1 drop-shadow-md">
                    Sucursal 6 de Agosto
                  </h3>
                </div>
              </div>
              <div className="p-4 sm:p-6">
                <p className="text-neutral-600 text-sm sm:text-base mb-4 leading-relaxed">
                  6 de Agosto esq. Av. Independencia
                </p>
                <div className="flex items-center justify-between">
                  <div className="flex items-center text-primary-700">
                    <Phone className="h-4 w-4 mr-2" />
                    <span className="text-sm font-medium">69420542</span>
                  </div>
                  <Link
                    href="https://maps.app.goo.gl/2PAXXDFaNFbnWaHJ7"
                    target="_blank"
                    rel="noopener noreferrer"
                    className="text-primary-700 hover:text-primary-600 transition-colors text-sm font-medium flex items-center"
                  >
                    <MapPin className="h-4 w-4 mr-1" />
                    Ver Mapa
                  </Link>
                </div>
              </div>
            </div>

            {/* Sucursal 2: Taquiña */}
            <div className="group bg-white rounded-xl shadow-soft hover:shadow-strong transition-all duration-300 overflow-hidden">
              <div className="relative h-48 sm:h-56">
                <Image
                  src="/ubiDos.jpg"
                  alt="Sucursal Taquiña"
                  fill
                  className="object-cover group-hover:scale-105 transition-transform duration-300"
                />
                <div className="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                <div className="absolute bottom-4 left-4 right-4">
                  <h3 className="text-white font-semibold text-lg mb-1 drop-shadow-md">
                    Sucursal Taquiña
                  </h3>
                </div>
              </div>
              <div className="p-4 sm:p-6">
                <p className="text-neutral-600 text-sm sm:text-base mb-4 leading-relaxed">
                  Av. Taquiña esq. Pasaje Coroico
                </p>
                <div className="flex items-center justify-between">
                  <div className="flex items-center text-primary-700">
                    <Phone className="h-4 w-4 mr-2" />
                    <span className="text-sm font-medium">69420542</span>
                  </div>
                  <Link
                    href="https://maps.app.goo.gl/neBc583WGKntXUXz8"
                    target="_blank"
                    rel="noopener noreferrer"
                    className="text-primary-700 hover:text-primary-600 transition-colors text-sm font-medium flex items-center"
                  >
                    <MapPin className="h-4 w-4 mr-1" />
                    Ver Mapa
                  </Link>
                </div>
              </div>
            </div>

            {/* Sucursal 3: Peru */}
            <div className="group bg-white rounded-xl shadow-soft hover:shadow-strong transition-all duration-300 overflow-hidden">
              <div className="relative h-48 sm:h-56">
                <Image
                  src="/ubiCuatro.jpg"
                  alt="Sucursal Peru"
                  fill
                  className="object-cover group-hover:scale-105 transition-transform duration-300"
                />
                <div className="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                <div className="absolute bottom-4 left-4 right-4">
                  <h3 className="text-white font-semibold text-lg mb-1 drop-shadow-md">
                    Sucursal Peru
                  </h3>
                </div>
              </div>
              <div className="p-4 sm:p-6">
                <p className="text-neutral-600 text-sm sm:text-base mb-4 leading-relaxed">
                  Av. Peru esq. calle 15 de Agosto
                </p>
                <div className="flex items-center justify-between">
                  <div className="flex items-center text-primary-700">
                    <Phone className="h-4 w-4 mr-2" />
                    <span className="text-sm font-medium">69420542</span>
                  </div>
                  <Link
                    href="https://maps.app.goo.gl/S58N8P7GSerMjqPz8"
                    target="_blank"
                    rel="noopener noreferrer"
                    className="text-primary-700 hover:text-primary-600 transition-colors text-sm font-medium flex items-center"
                  >
                    <MapPin className="h-4 w-4 mr-1" />
                    Ver Mapa
                  </Link>
                </div>
              </div>
            </div>
          </div>

          {/* Call to Action para Sucursales */}
          <div className="text-center mt-8 sm:mt-12">
            <div className="bg-gradient-to-r from-primary-50 to-secondary-50 rounded-2xl p-6 sm:p-8">
              <h3 className="text-xl sm:text-2xl font-display font-bold text-neutral-900 mb-3 sm:mb-4">
                ¿No sabes cuál sucursal te queda más cerca?
              </h3>
              <p className="text-neutral-600 mb-4 sm:mb-6 text-sm sm:text-base">
                Llámanos y te ayudamos a encontrar la sucursal más conveniente para ti
              </p>
              <a
                href="tel:+59169420542"
                className="inline-flex items-center justify-center px-6 sm:px-8 py-2.5 sm:py-3 bg-primary-700 text-white font-semibold rounded-lg hover:bg-primary-600 transition-all transform hover:scale-105 shadow-medium text-sm sm:text-base"
              >
                <Phone className="mr-2 h-4 w-4 sm:h-5 sm:w-5" />
                Llamar Ahora: 69420542
              </a>
            </div>
          </div>
        </div>
      </section>

      {/* CTA Section */}
      <section className="bg-gradient-to-r from-primary-700 to-primary-900 py-12 sm:py-16 w-full">
        <div className="w-full max-w-6xl mx-auto px-3 sm:px-4 md:px-6 lg:px-8 xl:px-12 2xl:px-16 text-center">
          <h2 className="text-2xl sm:text-3xl md:text-4xl font-display font-bold text-white mb-4 sm:mb-6">
            ¿Listo para Disfrutar de la Mejor Calidad?
          </h2>
          <p className="text-base sm:text-lg md:text-xl text-primary-100 mb-6 sm:mb-8 px-4">
            Visítanos en nuestra tienda o realiza tu pedido por WhatsApp. 
            Entrega a domicilio disponible en toda la ciudad.
          </p>
          <div className="flex flex-col sm:flex-row gap-3 sm:gap-4 justify-center">
            <Link
              href="/shop"
              className="inline-flex items-center justify-center px-6 sm:px-8 py-2.5 sm:py-3 bg-secondary-500 text-white font-semibold rounded-lg hover:bg-secondary-600 transition-all transform hover:scale-105 shadow-strong text-sm sm:text-base"
            >
              Comprar Ahora
              <ChevronRight className="ml-2 h-4 w-4 sm:h-5 sm:w-5" />
            </Link>
            <a
              href="https://wa.me/59169420542"
              target="_blank"
              rel="noopener noreferrer"
              className="inline-flex items-center justify-center px-6 sm:px-8 py-2.5 sm:py-3 bg-white text-primary-700 font-semibold rounded-lg hover:bg-neutral-100 transition-all transform hover:scale-105 shadow-strong text-sm sm:text-base"
            >
              <Phone className="mr-2 h-4 w-4 sm:h-5 sm:w-5" />
              Contactar por WhatsApp
            </a>
          </div>
        </div>
      </section>
    </Layout>
  )
}
