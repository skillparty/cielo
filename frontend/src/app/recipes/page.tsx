'use client'

import { useState } from 'react'
import Layout from '@/components/layout/Layout'
import RecipeHero from '@/components/recipes/RecipeHero'
import RecipeFilters from '@/components/recipes/RecipeFilters'
import RecipeGrid from '@/components/recipes/RecipeGrid'
import { useRecipes } from '@/hooks/useRecipes'
import { RecipeFilters as RecipeFiltersType } from '@/services/recipeService'

export default function RecipesPage() {
  const [filters, setFilters] = useState<RecipeFiltersType>({})
  const { recipes, loading, error, meta } = useRecipes(filters)

  const handleFiltersChange = (newFilters: RecipeFiltersType) => {
    setFilters(newFilters)
  }

  return (
    <Layout>
      <RecipeHero />
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <RecipeFilters onFiltersChange={handleFiltersChange} />
        <RecipeGrid 
          recipes={recipes} 
          loading={loading} 
          error={error} 
          meta={meta}
          onFiltersChange={handleFiltersChange}
          currentFilters={filters}
        />
      </div>
    </Layout>
  )
}
