import { api } from '@/lib/api'
import { Recipe } from '@/types'

export interface RecipeFilters {
  category_id?: string
  difficulty?: number
  search?: string
  sort?: 'newest' | 'title' | 'difficulty' | 'time'
  page?: number
  per_page?: number
}

export interface RecipesResponse {
  data: Recipe[]
  meta: {
    current_page: number
    last_page: number
    per_page: number
    total: number
  }
}

export const recipeService = {
  // Get all recipes with filters
  async getRecipes(filters: RecipeFilters = {}): Promise<RecipesResponse> {
    const response = await api.get('/recipes', { params: filters })
    return response.data
  },

  // Get featured recipes
  async getFeaturedRecipes(): Promise<Recipe[]> {
    const response = await api.get('/recipes/featured')
    return response.data.data
  },

  // Get single recipe
  async getRecipe(id: string): Promise<Recipe> {
    const response = await api.get(`/recipes/${id}`)
    return response.data.data
  },

  // Get recipes by difficulty
  async getRecipesByDifficulty(difficulty: number): Promise<RecipesResponse> {
    const response = await api.get(`/recipes/difficulty/${difficulty}`)
    return response.data
  }
}
