'use client'

import Link from 'next/link'
import { ClockIcon, UserGroupIcon, StarIcon } from '@heroicons/react/24/outline'
import { Card, CardContent, CardFooter } from '@/components/ui/Card'
import Button from '@/components/ui/Button'
import { Recipe } from '@/types'
import { RecipeFilters } from '@/services/recipeService'

interface RecipeGridProps {
  recipes: Recipe[]
  loading: boolean
  error: string | null
  meta: {
    current_page: number
    last_page: number
    per_page: number
    total: number
  }
  onFiltersChange: (filters: RecipeFilters) => void
  currentFilters: RecipeFilters
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

export default function RecipeGrid({ 
  recipes, 
  loading, 
  error, 
  meta, 
  onFiltersChange, 
  currentFilters 
}: RecipeGridProps) {
  
  const handlePageChange = (page: number) => {
    onFiltersChange({ ...currentFilters, page })
  }

  if (loading) {
    return (
      <div className="text-center py-12">
        <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-red-600 mx-auto mb-4"></div>
        <p className="text-gray-600">Cargando recetas...</p>
      </div>
    )
  }

  if (error) {
    return (
      <div className="text-center py-12">
        <p className="text-red-600">{error}</p>
      </div>
    )
  }

  if (recipes.length === 0) {
    return (
      <div className="text-center py-12">
        <div className="text-6xl mb-4">🍽️</div>
        <h3 className="text-xl font-semibold text-gray-900 mb-2">
          No se encontraron recetas
        </h3>
        <p className="text-gray-600">
          Intenta ajustar los filtros de búsqueda
        </p>
      </div>
    )
  }

  return (
    <div>
      {/* Results Info */}
      <div className="flex justify-between items-center mb-6">
        <p className="text-gray-600">
          Mostrando {recipes.length} de {meta.total} recetas
        </p>
      </div>

      {/* Recipe Grid */}
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
                <Link href={`/recipes/${recipe.id}`}>
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
            onClick={() => handlePageChange(meta.current_page - 1)}
            disabled={meta.current_page === 1}
          >
            Anterior
          </Button>
          
          <span className="px-4 py-2 text-sm text-gray-600">
            Página {meta.current_page} de {meta.last_page}
          </span>
          
          <Button
            variant="outline"
            onClick={() => handlePageChange(meta.current_page + 1)}
            disabled={meta.current_page === meta.last_page}
          >
            Siguiente
          </Button>
        </div>
      )}
    </div>
  )
}
