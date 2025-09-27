'use client'

import { useState, useEffect } from 'react'
import { recipeService, RecipeFilters } from '@/services/recipeService'
import { Recipe } from '@/types'

export function useRecipes(filters: RecipeFilters = {}) {
  const [recipes, setRecipes] = useState<Recipe[]>([])
  const [loading, setLoading] = useState(true)
  const [error, setError] = useState<string | null>(null)
  const [meta, setMeta] = useState({
    current_page: 1,
    last_page: 1,
    per_page: 12,
    total: 0
  })

  useEffect(() => {
    const fetchRecipes = async () => {
      try {
        setLoading(true)
        setError(null)
        const response = await recipeService.getRecipes(filters)
        setRecipes(response.data)
        setMeta(response.meta)
      } catch (err) {
        setError('Error al cargar las recetas')
        console.error('Error fetching recipes:', err)
      } finally {
        setLoading(false)
      }
    }

    fetchRecipes()
  }, [JSON.stringify(filters)])

  return { recipes, loading, error, meta }
}

export function useFeaturedRecipes() {
  const [recipes, setRecipes] = useState<Recipe[]>([])
  const [loading, setLoading] = useState(true)
  const [error, setError] = useState<string | null>(null)

  useEffect(() => {
    const fetchFeaturedRecipes = async () => {
      try {
        setLoading(true)
        setError(null)
        const data = await recipeService.getFeaturedRecipes()
        setRecipes(data)
      } catch (err) {
        setError('Error al cargar las recetas destacadas')
        console.error('Error fetching featured recipes:', err)
      } finally {
        setLoading(false)
      }
    }

    fetchFeaturedRecipes()
  }, [])

  return { recipes, loading, error }
}

export function useRecipe(id: string) {
  const [recipe, setRecipe] = useState<Recipe | null>(null)
  const [loading, setLoading] = useState(true)
  const [error, setError] = useState<string | null>(null)

  useEffect(() => {
    if (!id) return

    const fetchRecipe = async () => {
      try {
        setLoading(true)
        setError(null)
        const data = await recipeService.getRecipe(id)
        setRecipe(data)
      } catch (err) {
        setError('Error al cargar la receta')
        console.error('Error fetching recipe:', err)
      } finally {
        setLoading(false)
      }
    }

    fetchRecipe()
  }, [id])

  return { recipe, loading, error }
}
