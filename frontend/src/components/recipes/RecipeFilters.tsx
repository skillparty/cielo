'use client'

import { useState } from 'react'
import { MagnifyingGlassIcon, AdjustmentsHorizontalIcon } from '@heroicons/react/24/outline'
import { useCategories } from '@/hooks/useCategories'
import { RecipeFilters as RecipeFiltersType } from '@/services/recipeService'
import Button from '@/components/ui/Button'
import Input from '@/components/ui/Input'

interface RecipeFiltersProps {
  onFiltersChange: (filters: RecipeFiltersType) => void
}

const difficultyOptions = [
  { value: '', label: 'Todas las dificultades' },
  { value: '1', label: 'Fácil' },
  { value: '2', label: 'Media' },
  { value: '3', label: 'Difícil' }
]

const sortOptions = [
  { value: 'newest', label: 'Más recientes' },
  { value: 'title', label: 'Nombre A-Z' },
  { value: 'difficulty', label: 'Dificultad' },
  { value: 'time', label: 'Tiempo de cocción' }
]

export default function RecipeFilters({ onFiltersChange }: RecipeFiltersProps) {
  const [search, setSearch] = useState('')
  const [categoryId, setCategoryId] = useState('')
  const [difficulty, setDifficulty] = useState('')
  const [sort, setSort] = useState('newest')
  const [showFilters, setShowFilters] = useState(false)
  
  const { categories } = useCategories()

  const handleSearch = () => {
    const filters: RecipeFiltersType = {
      search: search || undefined,
      category_id: categoryId || undefined,
      difficulty: difficulty ? parseInt(difficulty) : undefined,
      sort: sort as any
    }
    onFiltersChange(filters)
  }

  const handleClearFilters = () => {
    setSearch('')
    setCategoryId('')
    setDifficulty('')
    setSort('newest')
    onFiltersChange({})
  }

  return (
    <div className="bg-white rounded-lg shadow-sm border p-6 mb-8">
      {/* Search Bar */}
      <div className="flex flex-col md:flex-row gap-4 mb-4">
        <div className="flex-1">
          <div className="relative">
            <MagnifyingGlassIcon className="absolute left-3 top-1/2 transform -translate-y-1/2 h-5 w-5 text-gray-400" />
            <input
              type="text"
              placeholder="Buscar recetas..."
              value={search}
              onChange={(e) => setSearch(e.target.value)}
              onKeyPress={(e) => e.key === 'Enter' && handleSearch()}
              className="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500"
            />
          </div>
        </div>
        <div className="flex gap-2">
          <Button onClick={handleSearch}>
            Buscar
          </Button>
          <Button
            variant="outline"
            onClick={() => setShowFilters(!showFilters)}
            className="md:hidden"
          >
            <AdjustmentsHorizontalIcon className="h-4 w-4" />
          </Button>
        </div>
      </div>

      {/* Filters */}
      <div className={`grid grid-cols-1 md:grid-cols-4 gap-4 ${showFilters ? 'block' : 'hidden md:grid'}`}>
        {/* Category Filter */}
        <div>
          <label className="block text-sm font-medium text-gray-700 mb-1">
            Categoría
          </label>
          <select
            value={categoryId}
            onChange={(e) => setCategoryId(e.target.value)}
            className="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500"
          >
            <option value="">Todas las categorías</option>
            {categories.map((category) => (
              <option key={category.id} value={category.id}>
                {category.name}
              </option>
            ))}
          </select>
        </div>

        {/* Difficulty Filter */}
        <div>
          <label className="block text-sm font-medium text-gray-700 mb-1">
            Dificultad
          </label>
          <select
            value={difficulty}
            onChange={(e) => setDifficulty(e.target.value)}
            className="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500"
          >
            {difficultyOptions.map((option) => (
              <option key={option.value} value={option.value}>
                {option.label}
              </option>
            ))}
          </select>
        </div>

        {/* Sort Filter */}
        <div>
          <label className="block text-sm font-medium text-gray-700 mb-1">
            Ordenar por
          </label>
          <select
            value={sort}
            onChange={(e) => setSort(e.target.value)}
            className="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500"
          >
            {sortOptions.map((option) => (
              <option key={option.value} value={option.value}>
                {option.label}
              </option>
            ))}
          </select>
        </div>

        {/* Actions */}
        <div className="flex items-end gap-2">
          <Button onClick={handleSearch} className="flex-1">
            Aplicar
          </Button>
          <Button variant="outline" onClick={handleClearFilters}>
            Limpiar
          </Button>
        </div>
      </div>
    </div>
  )
}
