'use client'

import Link from 'next/link'
import { ClockIcon, UserGroupIcon, ShoppingCartIcon, ArrowLeftIcon } from '@heroicons/react/24/outline'
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/Card'
import Button from '@/components/ui/Button'
import { Recipe } from '@/types'
import { formatPrice } from '@/lib/utils'
import { useCart } from '@/hooks/useCart'

interface RecipeDetailProps {
  recipe: Recipe
}

const getDifficultyLabel = (level: number) => {
  switch (level) {
    case 1: return 'Fácil'
    case 2: return 'Media'
    case 3: return 'Difícil'
    default: return 'Desconocida'
  }
}

const getDifficultyColor = (level: number) => {
  switch (level) {
    case 1: return 'bg-green-100 text-green-800'
    case 2: return 'bg-yellow-100 text-yellow-800'
    case 3: return 'bg-red-100 text-red-800'
    default: return 'bg-gray-100 text-gray-800'
  }
}

export default function RecipeDetail({ recipe }: RecipeDetailProps) {
  const { addToCart } = useCart()

  const handleAddToCart = async (productId: string) => {
    await addToCart(productId, 1)
  }

  return (
    <div className="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      {/* Back Button */}
      <div className="mb-6">
        <Link
          href="/recipes"
          className="inline-flex items-center text-red-600 hover:text-red-700 font-medium"
        >
          <ArrowLeftIcon className="h-4 w-4 mr-2" />
          Volver a recetas
        </Link>
      </div>

      <div className="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {/* Main Content */}
        <div className="lg:col-span-2">
          {/* Recipe Header */}
          <div className="mb-8">
            {/* Recipe Image */}
            <div className="aspect-video bg-gradient-to-br from-orange-100 to-red-200 rounded-lg mb-6 flex items-center justify-center">
              <span className="text-6xl">🍽️</span>
            </div>

            <div className="flex flex-wrap gap-2 mb-4">
              <span className={`text-sm px-3 py-1 rounded-full ${getDifficultyColor(recipe.difficulty_level)}`}>
                {getDifficultyLabel(recipe.difficulty_level)}
              </span>
              {recipe.category && (
                <span className="bg-red-100 text-red-800 text-sm px-3 py-1 rounded-full">
                  {recipe.category.name}
                </span>
              )}
            </div>

            <h1 className="text-3xl md:text-4xl font-bold text-gray-900 mb-2">
              {recipe.title}
            </h1>
            {recipe.subtitle && (
              <p className="text-xl text-gray-600 mb-4">{recipe.subtitle}</p>
            )}
            <p className="text-gray-700 leading-relaxed mb-6">
              {recipe.summary}
            </p>

            {/* Recipe Stats */}
            <div className="flex flex-wrap gap-6 text-sm text-gray-600">
              <div className="flex items-center">
                <ClockIcon className="h-5 w-5 mr-2 text-red-600" />
                <span>Preparación: {recipe.prep_time_minutes} min</span>
              </div>
              <div className="flex items-center">
                <ClockIcon className="h-5 w-5 mr-2 text-red-600" />
                <span>Cocción: {recipe.cook_time_minutes} min</span>
              </div>
              <div className="flex items-center">
                <UserGroupIcon className="h-5 w-5 mr-2 text-red-600" />
                <span>{recipe.servings} porciones</span>
              </div>
            </div>
          </div>

          {/* Instructions */}
          <Card className="mb-8">
            <CardHeader>
              <CardTitle>Instrucciones</CardTitle>
            </CardHeader>
            <CardContent>
              <div className="prose max-w-none">
                <div dangerouslySetInnerHTML={{ __html: recipe.instructions.replace(/\n/g, '<br>') }} />
              </div>
            </CardContent>
          </Card>

          {/* Video */}
          {recipe.video_url && (
            <Card className="mb-8">
              <CardHeader>
                <CardTitle>Video Tutorial</CardTitle>
              </CardHeader>
              <CardContent>
                <div className="aspect-video bg-gray-100 rounded-lg flex items-center justify-center">
                  <p className="text-gray-500">Video disponible: {recipe.video_url}</p>
                </div>
              </CardContent>
            </Card>
          )}
        </div>

        {/* Sidebar */}
        <div className="lg:col-span-1">
          {/* Required Products */}
          {recipe.products && recipe.products.length > 0 && (
            <Card className="mb-6">
              <CardHeader>
                <CardTitle>Productos Necesarios</CardTitle>
              </CardHeader>
              <CardContent>
                <div className="space-y-4">
                  {recipe.products.map((product) => (
                    <div key={product.id} className="flex items-center justify-between p-3 border rounded-lg">
                      <div className="flex-1">
                        <h4 className="font-medium text-gray-900">{product.name}</h4>
                        <p className="text-sm text-gray-600">{product.category?.name}</p>
                        <p className="text-lg font-bold text-red-600">
                          {formatPrice(product.base_price)}
                        </p>
                      </div>
                      <Button
                        size="sm"
                        onClick={() => handleAddToCart(product.id)}
                        disabled={product.stock <= 0}
                      >
                        <ShoppingCartIcon className="h-4 w-4" />
                      </Button>
                    </div>
                  ))}
                </div>
                <div className="mt-4 pt-4 border-t">
                  <Button className="w-full" size="lg">
                    Agregar Todos al Carrito
                  </Button>
                </div>
              </CardContent>
            </Card>
          )}

          {/* Nutrition Facts */}
          {recipe.nutrition_facts && (
            <Card className="mb-6">
              <CardHeader>
                <CardTitle>Información Nutricional</CardTitle>
              </CardHeader>
              <CardContent>
                <div className="text-sm text-gray-600">
                  <p>Información nutricional por porción</p>
                  {/* Aquí podrías mostrar los datos nutricionales si están disponibles */}
                </div>
              </CardContent>
            </Card>
          )}

          {/* Share Recipe */}
          <Card>
            <CardHeader>
              <CardTitle>Compartir Receta</CardTitle>
            </CardHeader>
            <CardContent>
              <div className="space-y-2">
                <Button variant="outline" className="w-full">
                  📱 WhatsApp
                </Button>
                <Button variant="outline" className="w-full">
                  📧 Email
                </Button>
                <Button variant="outline" className="w-full">
                  🔗 Copiar enlace
                </Button>
              </div>
            </CardContent>
          </Card>
        </div>
      </div>
    </div>
  )
}
