'use client'

import { useState } from 'react'
import { CheckIcon } from '@heroicons/react/24/outline'
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/Card'
import Button from '@/components/ui/Button'

const categories = [
  { id: 'all', name: 'Todos los Productos', count: 45 },
  { id: 'carnes', name: 'Carnes Frescas', count: 18 },
  { id: 'fiambres', name: 'Fiambres', count: 12 },
  { id: 'embutidos', name: 'Embutidos', count: 8 },
  { id: 'especiales', name: 'Productos Especiales', count: 7 }
]

const priceRanges = [
  { id: '0-50', label: 'Bs. 0 - 50', min: 0, max: 50 },
  { id: '50-100', label: 'Bs. 50 - 100', min: 50, max: 100 },
  { id: '100-200', label: 'Bs. 100 - 200', min: 100, max: 200 },
  { id: '200+', label: 'Bs. 200+', min: 200, max: null }
]

export default function CategoryFilter() {
  const [selectedCategory, setSelectedCategory] = useState('all')
  const [selectedPriceRanges, setSelectedPriceRanges] = useState<string[]>([])
  const [showFeatured, setShowFeatured] = useState(false)

  const togglePriceRange = (rangeId: string) => {
    setSelectedPriceRanges(prev => 
      prev.includes(rangeId) 
        ? prev.filter(id => id !== rangeId)
        : [...prev, rangeId]
    )
  }

  const clearFilters = () => {
    setSelectedCategory('all')
    setSelectedPriceRanges([])
    setShowFeatured(false)
  }

  return (
    <div className="space-y-6">
      {/* Categories */}
      <Card>
        <CardHeader>
          <CardTitle>Categorías</CardTitle>
        </CardHeader>
        <CardContent>
          <div className="space-y-2">
            {categories.map((category) => (
              <button
                key={category.id}
                onClick={() => setSelectedCategory(category.id)}
                className={`w-full text-left px-3 py-2 rounded-lg transition-colors ${
                  selectedCategory === category.id
                    ? 'bg-red-100 text-red-700 border border-red-200'
                    : 'hover:bg-gray-50'
                }`}
              >
                <div className="flex justify-between items-center">
                  <span className="font-medium">{category.name}</span>
                  <span className="text-sm text-gray-500">({category.count})</span>
                </div>
              </button>
            ))}
          </div>
        </CardContent>
      </Card>

      {/* Price Range */}
      <Card>
        <CardHeader>
          <CardTitle>Rango de Precio</CardTitle>
        </CardHeader>
        <CardContent>
          <div className="space-y-2">
            {priceRanges.map((range) => (
              <label
                key={range.id}
                className="flex items-center space-x-3 cursor-pointer hover:bg-gray-50 p-2 rounded-lg"
              >
                <div className="relative">
                  <input
                    type="checkbox"
                    checked={selectedPriceRanges.includes(range.id)}
                    onChange={() => togglePriceRange(range.id)}
                    className="sr-only"
                  />
                  <div className={`w-4 h-4 border-2 rounded flex items-center justify-center ${
                    selectedPriceRanges.includes(range.id)
                      ? 'bg-red-600 border-red-600'
                      : 'border-gray-300'
                  }`}>
                    {selectedPriceRanges.includes(range.id) && (
                      <CheckIcon className="w-3 h-3 text-white" />
                    )}
                  </div>
                </div>
                <span className="text-sm">{range.label}</span>
              </label>
            ))}
          </div>
        </CardContent>
      </Card>

      {/* Featured Products */}
      <Card>
        <CardHeader>
          <CardTitle>Filtros Especiales</CardTitle>
        </CardHeader>
        <CardContent>
          <label className="flex items-center space-x-3 cursor-pointer hover:bg-gray-50 p-2 rounded-lg">
            <div className="relative">
              <input
                type="checkbox"
                checked={showFeatured}
                onChange={(e) => setShowFeatured(e.target.checked)}
                className="sr-only"
              />
              <div className={`w-4 h-4 border-2 rounded flex items-center justify-center ${
                showFeatured
                  ? 'bg-red-600 border-red-600'
                  : 'border-gray-300'
              }`}>
                {showFeatured && (
                  <CheckIcon className="w-3 h-3 text-white" />
                )}
              </div>
            </div>
            <span className="text-sm">Solo productos destacados</span>
          </label>
        </CardContent>
      </Card>

      {/* Clear Filters */}
      <Button 
        variant="outline" 
        onClick={clearFilters}
        className="w-full"
      >
        Limpiar Filtros
      </Button>
    </div>
  )
}
