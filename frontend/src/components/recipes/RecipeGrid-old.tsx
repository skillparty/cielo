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

export default function RecipeGrid({ recipes, loading }: RecipeGridProps) {
  const [filteredRecipes, setFilteredRecipes] = useState<Recipe[]>(recipes)
  const [selectedDifficulty, setSelectedDifficulty] = useState<string>('all')

  useEffect(() => {
    if (selectedDifficulty === 'all') {
      setFilteredRecipes(recipes)
    } else {
      setFilteredRecipes(recipes.filter(recipe => recipe.difficulty_level === selectedDifficulty))
    }
  }, [recipes, selectedDifficulty])

  if (loading) {
    return (
      <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        {[...Array(6)].map((_, i) => (
          <div key={i} className="bg-neutral-100 rounded-xl h-96 animate-pulse"></div>
        ))}
      </div>
    )
  }

  return (
    <div>
      {/* Filters */}
      <div className="mb-8 flex flex-wrap gap-4">
        <button
          onClick={() => setSelectedDifficulty('all')}
          className={`px-6 py-2 rounded-lg font-medium transition-all ${
            selectedDifficulty === 'all'
              ? 'bg-primary-700 text-white shadow-soft'
              : 'bg-white text-neutral-700 hover:bg-neutral-50 border border-neutral-200'
          }`}
        >
          Todas las Recetas
        </button>
        <button
          onClick={() => setSelectedDifficulty('1')}
          className={`px-6 py-2 rounded-lg font-medium transition-all ${
            selectedDifficulty === '1'
              ? 'bg-success text-white shadow-soft'
              : 'bg-white text-neutral-700 hover:bg-neutral-50 border border-neutral-200'
          }`}
        >
          <span className="flex items-center gap-2">
            <div className="w-2 h-2 bg-success rounded-full"></div>
            Fácil
          </span>
        </button>
        <button
          onClick={() => setSelectedDifficulty('2')}
          className={`px-6 py-2 rounded-lg font-medium transition-all ${
            selectedDifficulty === '2'
              ? 'bg-warning text-white shadow-soft'
              : 'bg-white text-neutral-700 hover:bg-neutral-50 border border-neutral-200'
          }`}
        >
          <span className="flex items-center gap-2">
            <div className="w-2 h-2 bg-warning rounded-full"></div>
            Medio
          </span>
        </button>
        <button
          onClick={() => setSelectedDifficulty('3')}
          className={`px-6 py-2 rounded-lg font-medium transition-all ${
            selectedDifficulty === '3'
              ? 'bg-error text-white shadow-soft'
              : 'bg-white text-neutral-700 hover:bg-neutral-50 border border-neutral-200'
          }`}
        >
          <span className="flex items-center gap-2">
            <div className="w-2 h-2 bg-error rounded-full"></div>
            Difícil
          </span>
        </button>
      </div>

      {/* Grid */}
      <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        {filteredRecipes.map((recipe) => (
          <div
            key={recipe.id}
            className="group bg-white rounded-xl shadow-soft hover:shadow-strong transition-all transform hover:-translate-y-1"
          >
            {/* Image */}
            <Link href={`/recipes/${recipe.id}`}>
              <div className="relative h-56 bg-gradient-to-br from-neutral-100 to-neutral-200 rounded-t-xl overflow-hidden">
                {recipe.image_url ? (
                  <img
                    src={recipe.image_url}
                    alt={recipe.title}
                    className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                  />
                ) : (
                  <div className="w-full h-full flex items-center justify-center bg-gradient-to-br from-primary-50 to-secondary-50">
                    <ChefHat className="h-20 w-20 text-primary-300" />
                  </div>
                )}
                
                {/* Overlay gradient */}
                <div className="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                
                {/* Difficulty Badge */}
                <div className={`absolute top-4 right-4 px-3 py-1 rounded-full text-white text-sm font-semibold ${
                  recipe.difficulty_level === 1 ? 'bg-success' :
                  recipe.difficulty_level === 2 ? 'bg-warning' :
                  'bg-error'
                }`}>
                  {recipe.difficulty}
                </div>

                {/* Favorite Button */}
                <button className="absolute top-4 left-4 p-2 bg-white/90 backdrop-blur-sm rounded-full opacity-0 group-hover:opacity-100 transition-opacity hover:bg-white">
                  <Heart className="h-5 w-5 text-neutral-600 hover:text-primary-700" />
                </button>
              </div>
            </Link>

            {/* Content */}
            <div className="p-6">
              <Link href={`/recipes/${recipe.id}`}>
                <h3 className="text-xl font-semibold text-neutral-900 mb-2 group-hover:text-primary-700 transition-colors line-clamp-1">
                  {recipe.title}
                </h3>
              </Link>
              
              <p className="text-neutral-600 mb-4 line-clamp-2 text-sm leading-relaxed">
                {recipe.description}
              </p>
              
              {/* Rating */}
              <div className="flex items-center mb-4">
                <div className="flex">
                  {[...Array(5)].map((_, i) => (
                    <Star key={i} className={`h-4 w-4 ${i < 4 ? 'text-secondary-500 fill-current' : 'text-neutral-300'}`} />
                  ))}
                </div>
                <span className="ml-2 text-sm text-neutral-500">(4.5)</span>
              </div>
              
              {/* Meta Info */}
              <div className="flex items-center justify-between text-sm text-neutral-600 pb-4 border-b border-neutral-100">
                <div className="flex items-center">
                  <Clock className="h-4 w-4 mr-1.5 text-primary-600" />
                  <span>{recipe.prep_time + recipe.cook_time} min</span>
                </div>
                <div className="flex items-center">
                  <Users className="h-4 w-4 mr-1.5 text-primary-600" />
                  <span>{recipe.servings} porciones</span>
                </div>
              </div>

              {/* Action Button */}
              <Link
                href={`/recipes/${recipe.id}`}
                className="mt-4 w-full flex items-center justify-center gap-2 px-4 py-2 bg-primary-50 text-primary-700 rounded-lg hover:bg-primary-100 transition-colors font-medium"
              >
                <BookOpen className="h-4 w-4" />
                Ver Receta
              </Link>
            </div>
          </div>
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
