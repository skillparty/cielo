'use client'

import Link from 'next/link'
import { StarIcon, ShoppingCartIcon } from '@heroicons/react/24/solid'
import { Card, CardContent, CardFooter } from '@/components/ui/Card'
import Button from '@/components/ui/Button'
import { formatPrice } from '@/lib/utils'
import { useFeaturedProducts } from '@/hooks/useProducts'
import { useCart } from '@/hooks/useCart'

export default function FeaturedProducts() {
  const { products, loading, error } = useFeaturedProducts()
  const { addToCart } = useCart()

  const handleAddToCart = async (productId: string) => {
    await addToCart(productId, 1)
  }

  if (loading) {
    return (
      <section className="py-16 bg-white">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="text-center">
            <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-red-600 mx-auto"></div>
            <p className="mt-4 text-gray-600">Cargando productos destacados...</p>
          </div>
        </div>
      </section>
    )
  }

  if (error) {
    return (
      <section className="py-16 bg-white">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="text-center">
            <p className="text-red-600">{error}</p>
          </div>
        </div>
      </section>
    )
  }

  return (
    <section className="py-16 bg-white">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {/* Header */}
        <div className="text-center mb-12">
          <h2 className="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
            Productos Destacados
          </h2>
          <p className="text-xl text-gray-600 max-w-2xl mx-auto">
            Descubre nuestra selección de carnes y fiambres premium, 
            cuidadosamente seleccionados por su calidad excepcional.
          </p>
        </div>

        {/* Products Grid */}
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
          {products.map((product) => (
            <Card key={product.id} className="group hover:shadow-lg transition-shadow duration-300">
              <CardContent className="p-0">
                {/* Product Image */}
                <div className="relative aspect-square bg-gray-200 rounded-t-lg overflow-hidden">
                  <div className="absolute inset-0 bg-gradient-to-br from-red-100 to-red-200 flex items-center justify-center">
                    <span className="text-4xl">🥩</span>
                  </div>
                  {/* Category Badge */}
                  <div className="absolute top-3 left-3">
                    <span className="bg-red-600 text-white text-xs px-2 py-1 rounded-full">
                      {product.category?.name || 'Producto'}
                    </span>
                  </div>
                  {/* Featured Badge */}
                  {product.is_featured && (
                    <div className="absolute top-3 right-3 bg-yellow-500 text-white text-xs px-2 py-1 rounded-full">
                      Destacado
                    </div>
                  )}
                </div>

                {/* Product Info */}
                <div className="p-4">
                  <h3 className="font-semibold text-lg text-gray-900 mb-2 group-hover:text-red-600 transition-colors">
                    {product.name}
                  </h3>
                  <p className="text-gray-600 text-sm mb-3 line-clamp-2">
                    {product.description}
                  </p>
                  <div className="flex items-center justify-between">
                    <span className="text-2xl font-bold text-red-600">
                      {formatPrice(product.base_price)}
                    </span>
                    <span className="text-sm text-gray-500">por {product.unit_type || 'kg'}</span>
                  </div>
                </div>
              </CardContent>

              <CardFooter className="p-4 pt-0">
                <div className="flex gap-2 w-full">
                  <Button 
                    variant="outline" 
                    size="sm" 
                    className="flex-1"
                    asChild
                  >
                    <Link href={`/shop/${product.id}`}>
                      Ver Detalles
                    </Link>
                  </Button>
                  <Button 
                    size="sm" 
                    className="px-3"
                    onClick={() => handleAddToCart(product.id)}
                    disabled={product.stock <= 0}
                  >
                    <ShoppingCartIcon className="h-4 w-4" />
                  </Button>
                </div>
              </CardFooter>
            </Card>
          ))}
        </div>

        {/* Call to Action */}
        <div className="text-center">
          <Button size="lg" asChild>
            <Link href="/shop">
              Ver Todos los Productos
            </Link>
          </Button>
        </div>
      </div>
    </section>
  )
}
