'use client'

import { useParams } from 'next/navigation'
import Layout from '@/components/layout/Layout'
import RecipeDetail from '@/components/recipes/RecipeDetail'
import { useRecipe } from '@/hooks/useRecipes'

export default function RecipeDetailPage() {
  const params = useParams()
  const id = params.id as string
  const { recipe, loading, error } = useRecipe(id)

  if (loading) {
    return (
      <Layout>
        <div className="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
          <div className="text-center">
            <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-red-600 mx-auto mb-4"></div>
            <p className="text-gray-600">Cargando receta...</p>
          </div>
        </div>
      </Layout>
    )
  }

  if (error || !recipe) {
    return (
      <Layout>
        <div className="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
          <div className="text-center">
            <h1 className="text-2xl font-bold text-gray-900 mb-4">
              Receta no encontrada
            </h1>
            <p className="text-gray-600 mb-4">
              {error || 'La receta que buscas no existe o ha sido eliminada.'}
            </p>
            <a
              href="/recipes"
              className="text-red-600 hover:text-red-700 font-medium"
            >
              ← Volver a recetas
            </a>
          </div>
        </div>
      </Layout>
    )
  }

  return (
    <Layout>
      <RecipeDetail recipe={recipe} />
    </Layout>
  )
}
