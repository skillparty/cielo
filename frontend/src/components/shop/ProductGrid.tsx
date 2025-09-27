'use client'

import { useState } from 'react'
import Link from 'next/link'
import { StarIcon, ShoppingCartIcon, HeartIcon } from '@heroicons/react/24/solid'
import { HeartIcon as HeartOutline } from '@heroicons/react/24/outline'
import { Card, CardContent, CardFooter } from '@/components/ui/Card'
import Button from '@/components/ui/Button'
import { formatPrice } from '@/lib/utils'

// Mock data - En producción esto vendría de la API
const products = [
  {
    id: '1',
    name: 'Lomo de Cerdo Premium',
    description: 'Corte selecto de lomo de cerdo, ideal para asados especiales',
    price: 85.00,
    originalPrice: 95.00,
    image: '/images/products/lomo-cerdo.jpg',
    rating: 4.8,
    reviews: 24,
    category: 'Carnes Frescas',
    featured: true,
    inStock: true,
    discount: 10
  },
  {
    id: '2',
    name: 'Jamón Serrano Artesanal',
    description: 'Jamón curado artesanalmente con técnicas tradicionales',
    price: 120.00,
    image: '/images/products/jamon-serrano.jpg',
    rating: 4.9,
    reviews: 18,
    category: 'Fiambres',
    featured: true,
    inStock: true
  },
  {
    id: '3',
    name: 'Chorizo Parrillero',
    description: 'Chorizo especial para parrilla, con especias selectas',
    price: 45.00,
    image: '/images/products/chorizo.jpg',
    rating: 4.7,
    reviews: 32,
    category: 'Embutidos',
    featured: false,
    inStock: true
  },
  {
    id: '4',
    name: 'Costillas BBQ',
    description: 'Costillas de cerdo perfectas para barbacoa',
    price: 65.00,
    image: '/images/products/costillas.jpg',
    rating: 4.6,
    reviews: 15,
    category: 'Carnes Frescas',
    featured: false,
    inStock: true
  },
  {
    id: '5',
    name: 'Salami Italiano',
    description: 'Salami tradicional italiano con hierbas aromáticas',
    price: 75.00,
    image: '/images/products/salami.jpg',
    rating: 4.5,
    reviews: 21,
    category: 'Fiambres',
    featured: false,
    inStock: false
  },
  {
    id: '6',
    name: 'Tocino Ahumado',
    description: 'Tocino ahumado naturalmente, perfecto para desayunos',
    price: 55.00,
    image: '/images/products/tocino.jpg',
    rating: 4.4,
    reviews: 28,
    category: 'Carnes Frescas',
    featured: false,
    inStock: true
  }
]

export default function ProductGrid() {
  const [favorites, setFavorites] = useState<string[]>([])
  const [sortBy, setSortBy] = useState('name')

  const toggleFavorite = (productId: string) => {
    setFavorites(prev => 
      prev.includes(productId) 
        ? prev.filter(id => id !== productId)
        : [...prev, productId]
    )
  }

  const sortedProducts = [...products].sort((a, b) => {
    switch (sortBy) {
      case 'price-low':
        return a.price - b.price
      case 'price-high':
        return b.price - a.price
      case 'rating':
        return b.rating - a.rating
      case 'name':
      default:
        return a.name.localeCompare(b.name)
    }
  })

  return (
    <div>
      {/* Header with sorting */}
      <div className="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
        <div>
          <h2 className="text-2xl font-bold text-gray-900">Productos</h2>
          <p className="text-gray-600">Mostrando {products.length} productos</p>
        </div>
        <div className="mt-4 sm:mt-0">
          <select
            value={sortBy}
            onChange={(e) => setSortBy(e.target.value)}
            className="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500"
          >
            <option value="name">Ordenar por nombre</option>
            <option value="price-low">Precio: menor a mayor</option>
            <option value="price-high">Precio: mayor a menor</option>
            <option value="rating">Mejor calificación</option>
          </select>
        </div>
      </div>

      {/* Products Grid */}
      <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        {sortedProducts.map((product) => (
          <Card key={product.id} className="group hover:shadow-lg transition-shadow duration-300 relative overflow-hidden">
            {/* Badges */}
            <div className="absolute top-3 left-3 z-10 flex flex-col gap-2">
              {product.featured && (
                <span className="bg-yellow-500 text-white text-xs px-2 py-1 rounded-full font-medium">
                  Destacado
                </span>
              )}
              {product.discount && (
                <span className="bg-red-600 text-white text-xs px-2 py-1 rounded-full font-medium">
                  -{product.discount}%
                </span>
              )}
              {!product.inStock && (
                <span className="bg-gray-500 text-white text-xs px-2 py-1 rounded-full font-medium">
                  Agotado
                </span>
              )}
            </div>

            {/* Favorite Button */}
            <button
              onClick={() => toggleFavorite(product.id)}
              className="absolute top-3 right-3 z-10 p-2 bg-white rounded-full shadow-md hover:shadow-lg transition-shadow"
            >
              {favorites.includes(product.id) ? (
                <HeartIcon className="h-5 w-5 text-red-500" />
              ) : (
                <HeartOutline className="h-5 w-5 text-gray-400" />
              )}
            </button>

            <CardContent className="p-0">
              {/* Product Image */}
              <Link href={`/shop/${product.id}`}>
                <div className="relative aspect-square bg-gray-200 overflow-hidden cursor-pointer">
                  <div className="absolute inset-0 bg-gradient-to-br from-red-100 to-red-200 flex items-center justify-center group-hover:scale-105 transition-transform duration-300">
                    <span className="text-4xl">🥩</span>
                  </div>
                </div>
              </Link>

              {/* Product Info */}
              <div className="p-4">
                <div className="mb-2">
                  <span className="text-xs text-red-600 font-medium uppercase tracking-wide">
                    {product.category}
                  </span>
                </div>
                
                <Link href={`/shop/${product.id}`}>
                  <h3 className="font-semibold text-lg text-gray-900 mb-2 group-hover:text-red-600 transition-colors cursor-pointer">
                    {product.name}
                  </h3>
                </Link>
                
                <p className="text-gray-600 text-sm mb-3 line-clamp-2">
                  {product.description}
                </p>

                {/* Rating */}
                <div className="flex items-center mb-3">
                  <div className="flex items-center">
                    <StarIcon className="h-4 w-4 text-yellow-400" />
                    <span className="ml-1 text-sm font-medium">{product.rating}</span>
                  </div>
                  <span className="mx-2 text-gray-300">•</span>
                  <span className="text-sm text-gray-500">{product.reviews} reseñas</span>
                </div>

                {/* Price */}
                <div className="flex items-center justify-between">
                  <div className="flex items-center space-x-2">
                    <span className="text-2xl font-bold text-red-600">
                      {formatPrice(product.price)}
                    </span>
                    {product.originalPrice && (
                      <span className="text-sm text-gray-500 line-through">
                        {formatPrice(product.originalPrice)}
                      </span>
                    )}
                  </div>
                  <span className="text-sm text-gray-500">por kg</span>
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
                  disabled={!product.inStock}
                >
                  <ShoppingCartIcon className="h-4 w-4" />
                </Button>
              </div>
            </CardFooter>
          </Card>
        ))}
      </div>

      {/* Load More */}
      <div className="text-center mt-12">
        <Button variant="outline" size="lg">
          Cargar Más Productos
        </Button>
      </div>
    </div>
  )
}
