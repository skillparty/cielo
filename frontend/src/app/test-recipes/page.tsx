'use client'

import { useEffect, useState } from 'react'
import { recipeService } from '@/services/recipeService'
import { Recipe } from '@/types'
import Layout from '@/components/layout/Layout'

export default function TestRecipesPage() {
  const [recipes, setRecipes] = useState<Recipe[]>([])
  const [loading, setLoading] = useState(true)
  const [error, setError] = useState('')

  useEffect(() => {
    const testRecipesApi = async () => {
      try {
        setLoading(true)
        
        // Test featured recipes API
        const featuredRecipes = await recipeService.getFeaturedRecipes()
        setRecipes(featuredRecipes)
        
        setLoading(false)
      } catch (err) {
        setError('Error connecting to Recipes API: ' + (err as Error).message)
        setLoading(false)
      }
    }

    testRecipesApi()
  }, [])

  return (
    <Layout>
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h1 className="text-3xl font-bold mb-8">Recipes API Test</h1>
        
        {loading && (
          <div className="text-center">
            <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-red-600 mx-auto mb-4"></div>
            <p>Testing Recipes API connection...</p>
          </div>
        )}

        {error && (
          <div className="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {error}
          </div>
        )}

        {!loading && !error && (
          <div className="space-y-8">
            {/* Featured Recipes */}
            <div>
              <h2 className="text-2xl font-semibold mb-4">Featured Recipes ({recipes.length})</h2>
              <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                {recipes.map((recipe) => (
                  <div key={recipe.id} className="bg-white p-4 rounded-lg shadow border">
                    <h3 className="font-semibold">{recipe.title}</h3>
                    {recipe.subtitle && (
                      <p className="text-sm text-gray-600 mb-2">{recipe.subtitle}</p>
                    )}
                    <p className="text-sm text-gray-600 mb-2">{recipe.summary}</p>
                    <div className="flex justify-between text-xs text-gray-500">
                      <span>Prep: {recipe.prep_time_minutes} min</span>
                      <span>Cook: {recipe.cook_time_minutes} min</span>
                      <span>Serves: {recipe.servings}</span>
                    </div>
                    <p className="text-xs text-gray-500 mt-2">
                      Difficulty: {recipe.difficulty_level} | Category: {recipe.category?.name}
                    </p>
                  </div>
                ))}
              </div>
            </div>

            {/* Success Message */}
            <div className="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
              ✅ Recipes API connection successful! Recipe module is working properly.
            </div>

            {/* Navigation Links */}
            <div className="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded">
              <h3 className="font-semibold mb-2">Test the Recipe Module:</h3>
              <div className="space-y-2">
                <div>
                  <a href="/recipes" className="text-blue-600 hover:text-blue-800 underline">
                    → Go to Recipes Page
                  </a>
                </div>
                {recipes.length > 0 && (
                  <div>
                    <a href={`/recipes/${recipes[0].id}`} className="text-blue-600 hover:text-blue-800 underline">
                      → View First Recipe Detail
                    </a>
                  </div>
                )}
              </div>
            </div>
          </div>
        )}
      </div>
    </Layout>
  )
}
