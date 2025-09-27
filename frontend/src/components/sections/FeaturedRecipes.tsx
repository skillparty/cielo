'use client'

import Link from 'next/link'
import { ClockIcon, UserGroupIcon, ArrowRightIcon } from '@heroicons/react/24/outline'
import { Card, CardContent, CardFooter } from '@/components/ui/Card'
import Button from '@/components/ui/Button'
import { useFeaturedRecipes } from '@/hooks/useRecipes'

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

export default function FeaturedRecipes() {
  const { recipes, loading, error } = useFeaturedRecipes()

  if (loading) {
    return (
      <section className="py-16 bg-gray-50">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="text-center">
            <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-red-600 mx-auto"></div>
            <p className="mt-4 text-gray-600">Cargando recetas...</p>
          </div>
        </div>
      </section>
    )
  }

  if (error || !recipes.length) {
    return null // No mostrar la sección si hay error o no hay recetas
  }

  return (
    <section className="py-16 bg-gray-50">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {/* Header */}
        <div className="text-center mb-12">
          <h2 className="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
            Recetas Destacadas
          </h2>
          <p className="text-xl text-gray-600 max-w-2xl mx-auto">
            Descubre deliciosas recetas que puedes preparar con nuestros productos premium
          </p>
        </div>

        {/* Recipes Grid */}
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
          {recipes.slice(0, 6).map((recipe) => (
            <Card key={recipe.id} className="group hover:shadow-lg transition-shadow duration-300">
              <CardContent className="p-0">
                {/* Recipe Image */}
                <div className="relative aspect-video bg-gray-200 rounded-t-lg overflow-hidden">
                  <div className="absolute inset-0 bg-gradient-to-br from-orange-100 to-red-200 flex items-center justify-center">
                    <span className="text-4xl">🍽️</span>
                  </div>
                  
                  {/* Difficulty Badge */}
                  <div className="absolute top-3 left-3">
                    <span className={`text-xs px-2 py-1 rounded-full ${getDifficultyColor(recipe.difficulty_level)}`}>
                      {getDifficultyLabel(recipe.difficulty_level)}
                    </span>
                  </div>

                  {/* Category Badge */}
                  {recipe.category && (
                    <div className="absolute top-3 right-3">
                      <span className="bg-red-600 text-white text-xs px-2 py-1 rounded-full">
                        {recipe.category.name}
                      </span>
                    </div>
                  )}
                </div>

                {/* Recipe Info */}
                <div className="p-4">
                  <h3 className="font-semibold text-lg text-gray-900 mb-2 group-hover:text-red-600 transition-colors">
                    {recipe.title}
                  </h3>
                  {recipe.subtitle && (
                    <p className="text-sm text-gray-500 mb-2">{recipe.subtitle}</p>
                  )}
                  <p className="text-gray-600 text-sm mb-4 line-clamp-2">
                    {recipe.summary}
                  </p>

                  {/* Recipe Stats */}
                  <div className="flex items-center justify-between text-sm text-gray-500">
                    <div className="flex items-center">
                      <ClockIcon className="h-4 w-4 mr-1" />
                      <span>{recipe.prep_time_minutes + recipe.cook_time_minutes} min</span>
                    </div>
                    <div className="flex items-center">
                      <UserGroupIcon className="h-4 w-4 mr-1" />
                      <span>{recipe.servings} porciones</span>
                    </div>
                  </div>
                </div>
              </CardContent>

              <CardFooter className="p-4 pt-0">
                <Button 
                  variant="outline" 
                  className="w-full"
                  asChild
                >
                  <Link href={`/recipes/${recipe.id}`}>
                    Ver Receta
                  </Link>
                </Button>
              </CardFooter>
            </Card>
          ))}
        </div>

        {/* Call to Action */}
        <div className="text-center">
          <Button size="lg" asChild>
            <Link href="/recipes" className="inline-flex items-center">
              Ver Todas las Recetas
              <ArrowRightIcon className="ml-2 h-5 w-5" />
            </Link>
          </Button>
        </div>
      </div>
    </section>
  )
}
