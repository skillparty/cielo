import Layout from '@/components/layout/Layout'
import Link from 'next/link'
import Button from '@/components/ui/Button'

export default function Home() {
  return (
    <Layout>
      {/* Hero Section */}
      <section className="relative bg-gradient-hero text-white">
        <div className="absolute inset-0 bg-dark-900 opacity-20"></div>
        <div className="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 text-center">
          <h1 className="text-4xl md:text-6xl font-bold mb-6">
            Cielo Carnes
          </h1>
          <p className="text-xl md:text-2xl text-primary-100 max-w-3xl mx-auto mb-8">
            Más de 20 años ofreciendo carnes y fiambres de la más alta calidad. 
            Tradición familiar boliviana con productos premium para tu mesa.
          </p>
          <div className="flex flex-col sm:flex-row gap-4 justify-center">
            <Button size="lg" className="bg-white text-primary-700 hover:bg-neutral-100" asChild>
              <Link href="/shop">Ver Productos</Link>
            </Button>
            <Button size="lg" variant="outline" className="border-white text-white hover:bg-white hover:text-primary-700" asChild>
              <Link href="/recipes-simple">Ver Recetas</Link>
            </Button>
          </div>
        </div>
      </section>

      {/* Featured Products Section */}
      <section className="py-16 bg-white">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="text-center mb-12">
            <h2 className="text-3xl md:text-4xl font-bold text-dark-900 mb-4">
              Productos Destacados
            </h2>
            <p className="text-xl text-neutral-600 max-w-2xl mx-auto">
              Descubre nuestra selección de carnes y fiambres premium
            </p>
          </div>
          <div className="text-center">
            <Button size="lg" className="bg-primary-700 hover:bg-primary-800 text-white" asChild>
              <Link href="/shop">Ver Todos los Productos</Link>
            </Button>
          </div>
        </div>
      </section>

      {/* Featured Recipes Section */}
      <section className="py-16 bg-neutral-50">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="text-center mb-12">
            <h2 className="text-3xl md:text-4xl font-bold text-dark-900 mb-4">
              Recetas Destacadas
            </h2>
            <p className="text-xl text-neutral-600 max-w-2xl mx-auto">
              Aprende a preparar deliciosos platos con nuestros productos
            </p>
          </div>
          <div className="text-center">
            <Button size="lg" className="bg-secondary-500 hover:bg-secondary-600 text-white" asChild>
              <Link href="/recipes-simple">Ver Todas las Recetas</Link>
            </Button>
          </div>
        </div>
      </section>

      {/* Why Choose Us */}
      <section className="py-16 bg-white">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="text-center mb-12">
            <h2 className="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
              ¿Por qué elegir Cielo Carnes?
            </h2>
            <p className="text-xl text-gray-600 max-w-2xl mx-auto">
              Nos distinguimos por nuestra calidad, tradición y compromiso con la excelencia
            </p>
          </div>

          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div className="text-center">
              <div className="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <span className="text-2xl">🥩</span>
              </div>
              <h3 className="text-xl font-semibold text-gray-900 mb-3">
                Calidad Premium
              </h3>
              <p className="text-gray-600">
                Seleccionamos cuidadosamente cada producto para garantizar la máxima calidad
              </p>
            </div>

            <div className="text-center">
              <div className="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <span className="text-2xl">👨‍👩‍👧‍👦</span>
              </div>
              <h3 className="text-xl font-semibold text-gray-900 mb-3">
                Tradición Familiar
              </h3>
              <p className="text-gray-600">
                Más de 20 años de experiencia familiar en el sector cárnico boliviano
              </p>
            </div>

            <div className="text-center">
              <div className="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <span className="text-2xl">🚚</span>
              </div>
              <h3 className="text-xl font-semibold text-gray-900 mb-3">
                Entrega Fresca
              </h3>
              <p className="text-gray-600">
                Mantenemos la cadena de frío para que recibas productos frescos y seguros
              </p>
            </div>

            <div className="text-center">
              <div className="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <span className="text-2xl">⭐</span>
              </div>
              <h3 className="text-xl font-semibold text-gray-900 mb-3">
                Servicio Excepcional
              </h3>
              <p className="text-gray-600">
                Atención personalizada y asesoramiento experto para cada cliente
              </p>
            </div>
          </div>
        </div>
      </section>

      {/* Call to Action */}
      <section className="py-16 bg-red-600">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
          <h2 className="text-3xl md:text-4xl font-bold text-white mb-4">
            ¿Listo para disfrutar de la mejor calidad?
          </h2>
          <p className="text-xl text-red-100 mb-8 max-w-2xl mx-auto">
            Explora nuestros productos premium y descubre por qué somos la elección 
            preferida de las familias bolivianas.
          </p>
          <div className="flex flex-col sm:flex-row gap-4 justify-center">
            <Button size="lg" className="bg-white text-red-600 hover:bg-gray-100" asChild>
              <Link href="/shop">Comprar Ahora</Link>
            </Button>
            <Button size="lg" variant="outline" className="border-white text-white hover:bg-white hover:text-red-600" asChild>
              <Link href="/contact">Contáctanos</Link>
            </Button>
          </div>
        </div>
      </section>
    </Layout>
  )
}
