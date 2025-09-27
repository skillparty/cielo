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
      <section className="bg-gradient-to-r from-red-600 to-red-800 text-white py-20">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
          <h1 className="text-4xl md:text-6xl font-bold mb-6">
            Recetas Deliciosas
          </h1>
          <p className="text-xl md:text-2xl text-red-100 max-w-3xl mx-auto mb-8">
            Descubre recetas increíbles usando nuestros productos premium. 
            Desde platos tradicionales hasta creaciones modernas.
          </p>
        </div>
      </section>

      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        {/* Simple Search */}
        <div className="mb-8">
          <div className="flex gap-4 mb-4">
            <input
              type="text"
              placeholder="Buscar recetas..."
              className="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500"
              onChange={(e) => setFilters({ ...filters, search: e.target.value })}
            />
            <select
              className="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500"
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
          <div className="text-center py-12">
            <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-red-600 mx-auto mb-4"></div>
            <p className="text-gray-600">Cargando recetas...</p>
          </div>
        )}

        {/* Error State */}
        {error && (
          <div className="text-center py-12">
            <p className="text-red-600">{error}</p>
          </div>
        )}

        {/* Empty State */}
        {!loading && !error && recipes.length === 0 && (
          <div className="text-center py-12">
            <div className="text-6xl mb-4">🍽️</div>
            <h3 className="text-xl font-semibold text-gray-900 mb-2">
              No se encontraron recetas
            </h3>
            <p className="text-gray-600">
              Intenta ajustar los filtros de búsqueda
            </p>
          </div>
        )}

        {/* Recipes Grid */}
        {!loading && !error && recipes.length > 0 && (
          <div>
            <div className="flex justify-between items-center mb-6">
              <p className="text-gray-600">
                Mostrando {recipes.length} de {meta.total} recetas
              </p>
            </div>

            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
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
                      <Link href={`/recipes-simple/${recipe.id}`}>
                        Ver Receta Completa
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
