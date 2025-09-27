import Link from 'next/link'
import { ArrowRightIcon } from '@heroicons/react/24/outline'
import Button from '@/components/ui/Button'

export default function HeroSection() {
  return (
    <section className="relative bg-gradient-to-r from-red-600 to-red-800 text-white overflow-hidden">
      {/* Background Pattern */}
      <div className="absolute inset-0 bg-black opacity-40"></div>
      <div className="absolute inset-0 bg-[url('/images/meat-pattern.svg')] opacity-10"></div>
      
      <div className="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-32">
        <div className="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
          {/* Content */}
          <div className="text-center lg:text-left">
            <h1 className="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight">
              Bienvenido a{' '}
              <span className="text-yellow-300">Cielo Carnes</span>
            </h1>
            <p className="text-xl md:text-2xl mb-8 text-red-100 max-w-2xl">
              Especialistas en carnes y fiambres de cerdo de la más alta calidad. 
              Tradición familiar con más de 20 años de experiencia.
            </p>
            <div className="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
              <Button 
                size="lg" 
                className="bg-white text-red-600 hover:bg-gray-100 shadow-lg"
                asChild
              >
                <Link href="/shop">
                  Explorar Tienda
                  <ArrowRightIcon className="ml-2 h-5 w-5" />
                </Link>
              </Button>
              <Button 
                variant="outline" 
                size="lg"
                className="border-2 border-white text-white hover:bg-white hover:text-red-600"
                asChild
              >
                <Link href="/about">
                  Nuestra Historia
                </Link>
              </Button>
            </div>
          </div>

          {/* Hero Image */}
          <div className="relative">
            <div className="relative z-10 bg-white rounded-2xl shadow-2xl p-8 transform rotate-3 hover:rotate-0 transition-transform duration-300">
              <div className="aspect-square bg-gradient-to-br from-red-100 to-red-200 rounded-xl flex items-center justify-center">
                <div className="text-center">
                  <div className="w-24 h-24 bg-red-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span className="text-white text-3xl font-bold">🥩</span>
                  </div>
                  <h3 className="text-xl font-bold text-red-800 mb-2">Calidad Premium</h3>
                  <p className="text-red-600">Carnes frescas seleccionadas</p>
                </div>
              </div>
            </div>
            {/* Floating Elements */}
            <div className="absolute -top-4 -right-4 w-20 h-20 bg-yellow-300 rounded-full flex items-center justify-center shadow-lg animate-bounce">
              <span className="text-2xl">⭐</span>
            </div>
            <div className="absolute -bottom-4 -left-4 w-16 h-16 bg-green-400 rounded-full flex items-center justify-center shadow-lg animate-pulse">
              <span className="text-xl">🌿</span>
            </div>
          </div>
        </div>

        {/* Stats */}
        <div className="mt-16 grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
          <div>
            <div className="text-3xl font-bold text-yellow-300">20+</div>
            <div className="text-red-100">Años de Experiencia</div>
          </div>
          <div>
            <div className="text-3xl font-bold text-yellow-300">1000+</div>
            <div className="text-red-100">Clientes Satisfechos</div>
          </div>
          <div>
            <div className="text-3xl font-bold text-yellow-300">50+</div>
            <div className="text-red-100">Productos Disponibles</div>
          </div>
          <div>
            <div className="text-3xl font-bold text-yellow-300">100%</div>
            <div className="text-red-100">Calidad Garantizada</div>
          </div>
        </div>
      </div>
    </section>
  )
}
