'use client'

import { useState } from 'react'
import Layout from '@/components/layout/Layout'
import { useRecipes } from '@/hooks/useRecipes'
import { RecipeFilters } from '@/services/recipeService'
import Link from 'next/link'
import { ClockIcon, UserGroupIcon } from '@heroicons/react/24/outline'
import { Card, CardContent, CardFooter } from '@/components/ui/Card'
import Button from '@/components/ui/Button'

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

export default function RecipesSimplePage() {
  const [filters, setFilters] = useState<RecipeFilters>({})
  const { recipes, loading, error, meta } = useRecipes(filters)

  return (
    <Layout>
      {/* Hero Section */}
      <section className="bg-gradient-to-r from-primary-700 to-primary-900 text-white py-16 sm:py-20 w-full">
        <div className="w-full mx-auto px-3 sm:px-4 md:px-6 lg:px-8 xl:px-12 2xl:px-16 text-center">
          <h1 className="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-display font-bold mb-4 sm:mb-6 leading-tight">
            Recetas Deliciosas
          </h1>
          <p className="text-base sm:text-lg md:text-xl lg:text-2xl text-primary-100 max-w-3xl mx-auto mb-6 sm:mb-8 leading-relaxed">
            Descubre recetas increíbles usando nuestros productos premium. 
            Desde platos tradicionales hasta creaciones modernas.
          </p>
        </div>
      </section>

      <div className="w-full mx-auto px-3 sm:px-4 md:px-6 lg:px-8 xl:px-12 2xl:px-16 py-8 sm:py-12">
        {/* Simple Search */}
        <div className="mb-6 sm:mb-8">
          <div className="flex flex-col sm:flex-row gap-3 sm:gap-4 mb-4">
            <input
              type="text"
              placeholder="Buscar recetas..."
              className="flex-1 px-3 sm:px-4 py-2 text-sm sm:text-base border border-neutral-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
              onChange={(e) => setFilters({ ...filters, search: e.target.value })}
            />
            <select
              className="px-3 sm:px-4 py-2 text-sm sm:text-base border border-neutral-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
              onChange={(e) => setFilters({ ...filters, difficulty: e.target.value ? parseInt(e.target.value) : undefined })}
            >
              <option value="">Todas las dificultades</option>
              <option value="1">Fácil</option>
              <option value="2">Media</option>
              <option value="3">Difícil</option>
            </select>
          </div>
        </div>

        {/* Loading State */}
        {loading && (
          <div className="text-center py-8 sm:py-12">
            <div className="animate-spin rounded-full h-10 w-10 sm:h-12 sm:w-12 border-b-2 border-primary-700 mx-auto mb-3 sm:mb-4"></div>
            <p className="text-sm sm:text-base text-neutral-600">Cargando recetas...</p>
          </div>
        )}

        {/* Error State */}
        {error && (
          <div className="text-center py-8 sm:py-12">
            <p className="text-sm sm:text-base text-error">{error}</p>
          </div>
        )}

        {/* Empty State */}
        {!loading && !error && recipes.length === 0 && (
          <div className="text-center py-8 sm:py-12">
            <div className="text-4xl sm:text-5xl md:text-6xl mb-3 sm:mb-4">🍽️</div>
            <h3 className="text-lg sm:text-xl font-semibold text-neutral-900 mb-2">
              No se encontraron recetas
            </h3>
            <p className="text-sm sm:text-base text-neutral-600">
              Intenta ajustar los filtros de búsqueda
            </p>
          </div>
        )}

        {/* Recipes Grid */}
        {!loading && !error && recipes.length > 0 && (
          <div>
            <div className="flex justify-between items-center mb-4 sm:mb-6">
              <p className="text-sm sm:text-base text-neutral-600">
                Mostrando {recipes.length} de {meta.total} recetas
              </p>
            </div>

            <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-6 mb-6 sm:mb-8">
              {recipes.map((recipe) => (
                <Card key={recipe.id} className="group hover:shadow-lg transition-shadow duration-300">
                  <CardContent className="p-0">
                    {/* Recipe Image */}
                    <div className="relative aspect-video bg-gray-200 rounded-t-lg overflow-hidden">
                      <div className="absolute inset-0 bg-gradient-to-br from-orange-100 to-red-200 flex items-center justify-center">
                        <span className="text-4xl">🍽️</span>
                      </div>
                      
                      {/* Difficulty Badge */}
                      <div className="absolute top-3 left-3">
                        <span className={`text-xs px-2 py-1 rounded-full font-medium ${getDifficultyColor(recipe.difficulty_level)}`}>
                          {getDifficultyLabel(recipe.difficulty_level)}
                        </span>
                      </div>

                      {/* Category Badge */}
                      {recipe.category && (
                        <div className="absolute top-3 right-3">
                          <span className="bg-primary-700 text-white text-xs px-2 py-1 rounded-full font-medium">
                            {recipe.category.name}
                          </span>
                        </div>
                      )}
                    </div>

                    {/* Recipe Info */}
                    <div className="p-3 sm:p-4">
                      <h3 className="font-semibold text-base sm:text-lg text-neutral-900 mb-2 group-hover:text-primary-700 transition-colors">
                        {recipe.title}
                      </h3>
                      {recipe.subtitle && (
                        <p className="text-xs sm:text-sm text-neutral-500 mb-2">{recipe.subtitle}</p>
                      )}
                      <p className="text-neutral-600 text-xs sm:text-sm mb-3 sm:mb-4 line-clamp-2">
                        {recipe.summary}
                      </p>

                      {/* Recipe Stats */}
                      <div className="flex items-center justify-between text-xs sm:text-sm text-neutral-500">
                        <div className="flex items-center">
                          <ClockIcon className="h-3 w-3 sm:h-4 sm:w-4 mr-1" />
                          <span>{recipe.prep_time_minutes + recipe.cook_time_minutes} min</span>
                        </div>
                        <div className="flex items-center">
                          <UserGroupIcon className="h-3 w-3 sm:h-4 sm:w-4 mr-1" />
                          <span>{recipe.servings} porciones</span>
                        </div>
                      </div>
                    </div>
                  </CardContent>

                  <CardFooter className="p-3 sm:p-4 pt-0">
                    <Button 
                      variant="outline" 
                      className="w-full text-xs sm:text-sm"
                      asChild
                    >
                      <Link href={`/recipes-simple/${recipe.id}`}>
                        <span className="hidden sm:inline">Ver Receta Completa</span>
                        <span className="sm:hidden">Ver Receta</span>
                      </Link>
                    </Button>
                  </CardFooter>
                </Card>
              ))}
            </div>

            {/* Pagination */}
            {meta.last_page > 1 && (
              <div className="flex justify-center items-center space-x-2">
                <Button
                  variant="outline"
                  onClick={() => setFilters({ ...filters, page: meta.current_page - 1 })}
                  disabled={meta.current_page === 1}
                >
                  Anterior
                </Button>
                
                <span className="px-4 py-2 text-sm text-gray-600">
                  Página {meta.current_page} de {meta.last_page}
                </span>
                
                <Button
                  variant="outline"
                  onClick={() => setFilters({ ...filters, page: meta.current_page + 1 })}
                  disabled={meta.current_page === meta.last_page}
                >
                  Siguiente
                </Button>
              </div>
            )}
          </div>
        )}
      </div>
    </Layout>
  )
}
