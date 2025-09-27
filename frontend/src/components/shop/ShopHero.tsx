import { MagnifyingGlassIcon } from '@heroicons/react/24/outline'
import Input from '@/components/ui/Input'
import Button from '@/components/ui/Button'

export default function ShopHero() {
  return (
    <section className="bg-gradient-to-r from-red-50 to-red-100 py-16">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="text-center">
          <h1 className="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
            Nuestra Tienda
          </h1>
          <p className="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
            Explora nuestra amplia selección de carnes frescas, fiambres y embutidos 
            de la más alta calidad.
          </p>
          
          {/* Search Bar */}
          <div className="max-w-md mx-auto">
            <div className="relative">
              <Input
                type="text"
                placeholder="Buscar productos..."
                className="pl-10 pr-4 py-3 text-lg"
              />
              <MagnifyingGlassIcon className="absolute left-3 top-1/2 transform -translate-y-1/2 h-5 w-5 text-gray-400" />
              <Button className="absolute right-2 top-1/2 transform -translate-y-1/2" size="sm">
                Buscar
              </Button>
            </div>
          </div>
        </div>
      </div>
    </section>
  )
}
