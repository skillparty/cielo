'use client'

import { useState, useEffect } from 'react'
import Layout from '@/components/layout/Layout'
import { useProducts } from '@/hooks/useProducts'
import { useCategories } from '@/hooks/useCategories'
import { 
  Filter, 
  Grid, 
  List, 
  ChevronDown,
  Star,
  ShoppingCart,
  Heart,
  Search,
  X,
  SlidersHorizontal
} from 'lucide-react'

export default function ShopPage() {
  const { products, loading: productsLoading } = useProducts()
  const { categories, loading: categoriesLoading } = useCategories()
  
  const [filteredProducts, setFilteredProducts] = useState(products)
  const [selectedCategory, setSelectedCategory] = useState<string>('all')
  const [priceRange, setPriceRange] = useState<[number, number]>([0, 500])
  const [sortBy, setSortBy] = useState('featured')
  const [viewMode, setViewMode] = useState<'grid' | 'list'>('grid')
  const [searchTerm, setSearchTerm] = useState('')
  const [mobileFiltersOpen, setMobileFiltersOpen] = useState(false)

  useEffect(() => {
    let filtered = [...products]

    // Filter by category
    if (selectedCategory !== 'all') {
      filtered = filtered.filter(p => p.category_id === parseInt(selectedCategory))
    }

    // Filter by search term
    if (searchTerm) {
      filtered = filtered.filter(p => 
        p.name.toLowerCase().includes(searchTerm.toLowerCase()) ||
        p.description?.toLowerCase().includes(searchTerm.toLowerCase())
      )
    }

    // Filter by price range
    filtered = filtered.filter(p => 
      p.price >= priceRange[0] && p.price <= priceRange[1]
    )

    // Sort products
    switch (sortBy) {
      case 'price-asc':
        filtered.sort((a, b) => a.price - b.price)
        break
      case 'price-desc':
        filtered.sort((a, b) => b.price - a.price)
        break
      case 'name':
        filtered.sort((a, b) => a.name.localeCompare(b.name))
        break
      default:
        // Keep original order for 'featured'
        break
    }

    setFilteredProducts(filtered)
  }, [products, selectedCategory, priceRange, sortBy, searchTerm])

  const loading = productsLoading || categoriesLoading

  return (
    <Layout>
      {/* Hero Section */}
      <section className="bg-gradient-to-r from-primary-700 to-primary-900 py-16">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <h1 className="text-4xl md:text-5xl font-display font-bold text-white mb-4">
            Nuestra Tienda
          </h1>
          <p className="text-xl text-primary-100 max-w-2xl">
            Explora nuestra selección premium de carnes frescas, fiambres y productos especiales
          </p>
        </div>
      </section>

      {/* Search and Controls Bar */}
      <div className="bg-white border-b border-neutral-200 sticky top-20 z-40">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
          <div className="flex flex-col sm:flex-row gap-4">
            {/* Search */}
            <div className="flex-1 relative">
              <Search className="absolute left-3 top-1/2 -translate-y-1/2 h-5 w-5 text-neutral-400" />
              <input
                type="text"
                placeholder="Buscar productos..."
                value={searchTerm}
                onChange={(e) => setSearchTerm(e.target.value)}
                className="w-full pl-10 pr-4 py-2 border border-neutral-300 rounded-lg focus:outline-none focus:border-primary-500 focus:ring-1 focus:ring-primary-500"
              />
              {searchTerm && (
                <button
                  onClick={() => setSearchTerm('')}
                  className="absolute right-3 top-1/2 -translate-y-1/2 text-neutral-400 hover:text-neutral-600"
                >
                  <X className="h-5 w-5" />
                </button>
              )}
            </div>

            {/* Sort */}
            <select
              value={sortBy}
              onChange={(e) => setSortBy(e.target.value)}
              className="px-4 py-2 border border-neutral-300 rounded-lg focus:outline-none focus:border-primary-500 focus:ring-1 focus:ring-primary-500"
            >
              <option value="featured">Destacados</option>
              <option value="name">Nombre A-Z</option>
              <option value="price-asc">Precio: Menor a Mayor</option>
              <option value="price-desc">Precio: Mayor a Menor</option>
            </select>

            {/* View Mode */}
            <div className="flex gap-2">
              <button
                onClick={() => setViewMode('grid')}
                className={`p-2 rounded-lg transition-colors ${
                  viewMode === 'grid' 
                    ? 'bg-primary-700 text-white' 
                    : 'bg-neutral-100 text-neutral-600 hover:bg-neutral-200'
                }`}
              >
                <Grid className="h-5 w-5" />
              </button>
              <button
                onClick={() => setViewMode('list')}
                className={`p-2 rounded-lg transition-colors ${
                  viewMode === 'list' 
                    ? 'bg-primary-700 text-white' 
                    : 'bg-neutral-100 text-neutral-600 hover:bg-neutral-200'
                }`}
              >
                <List className="h-5 w-5" />
              </button>
            </div>

            {/* Mobile Filters Toggle */}
            <button
              onClick={() => setMobileFiltersOpen(!mobileFiltersOpen)}
              className="lg:hidden flex items-center gap-2 px-4 py-2 bg-primary-700 text-white rounded-lg hover:bg-primary-600 transition-colors"
            >
              <SlidersHorizontal className="h-5 w-5" />
              Filtros
            </button>
          </div>
        </div>
      </div>

      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div className="flex gap-8">
          {/* Filters Sidebar */}
          <aside className={`${
            mobileFiltersOpen ? 'fixed inset-0 z-50 bg-white' : 'hidden'
          } lg:block lg:relative lg:w-64 flex-shrink-0`}>
            <div className="lg:sticky lg:top-32 space-y-6">
              {/* Mobile Filter Header */}
              {mobileFiltersOpen && (
                <div className="flex items-center justify-between p-4 border-b lg:hidden">
                  <h2 className="text-lg font-semibold">Filtros</h2>
                  <button
                    onClick={() => setMobileFiltersOpen(false)}
                    className="p-2 hover:bg-neutral-100 rounded-lg"
                  >
                    <X className="h-5 w-5" />
                  </button>
                </div>
              )}

              <div className="p-4 lg:p-0 space-y-6">
                {/* Categories */}
                <div>
                  <h3 className="text-lg font-semibold text-neutral-900 mb-4 flex items-center">
                    <Filter className="h-5 w-5 mr-2" />
                    Categorías
                  </h3>
                  <div className="space-y-2">
                    <label className="flex items-center cursor-pointer hover:text-primary-700 transition-colors">
                      <input
                        type="radio"
                        name="category"
                        value="all"
                        checked={selectedCategory === 'all'}
                        onChange={(e) => setSelectedCategory(e.target.value)}
                        className="mr-3 text-primary-700 focus:ring-primary-500"
                      />
                      <span className={selectedCategory === 'all' ? 'font-semibold text-primary-700' : ''}>
                        Todos los productos
                      </span>
                    </label>
                    {categories.map((category) => (
                      <label key={category.id} className="flex items-center cursor-pointer hover:text-primary-700 transition-colors">
                        <input
                          type="radio"
                          name="category"
                          value={category.id.toString()}
                          checked={selectedCategory === category.id.toString()}
                          onChange={(e) => setSelectedCategory(e.target.value)}
                          className="mr-3 text-primary-700 focus:ring-primary-500"
                        />
                        <span className={selectedCategory === category.id.toString() ? 'font-semibold text-primary-700' : ''}>
                          {category.name}
                        </span>
                      </label>
                    ))}
                  </div>
                </div>

                {/* Price Range */}
                <div>
                  <h3 className="text-lg font-semibold text-neutral-900 mb-4">
                    Rango de Precio
                  </h3>
                  <div className="space-y-4">
                    <div className="flex items-center gap-4">
                      <input
                        type="number"
                        min="0"
                        max="500"
                        value={priceRange[0]}
                        onChange={(e) => setPriceRange([parseInt(e.target.value), priceRange[1]])}
                        className="w-full px-3 py-2 border border-neutral-300 rounded-lg focus:outline-none focus:border-primary-500"
                        placeholder="Min"
                      />
                      <span className="text-neutral-500">-</span>
                      <input
                        type="number"
                        min="0"
                        max="500"
                        value={priceRange[1]}
                        onChange={(e) => setPriceRange([priceRange[0], parseInt(e.target.value)])}
                        className="w-full px-3 py-2 border border-neutral-300 rounded-lg focus:outline-none focus:border-primary-500"
                        placeholder="Max"
                      />
                    </div>
                    <div className="text-sm text-neutral-600">
                      Bs. {priceRange[0]} - Bs. {priceRange[1]}
                    </div>
                  </div>
                </div>

                {/* Special Filters */}
                <div>
                  <h3 className="text-lg font-semibold text-neutral-900 mb-4">
                    Filtros Especiales
                  </h3>
                  <div className="space-y-2">
                    <label className="flex items-center cursor-pointer">
                      <input type="checkbox" className="mr-3 text-primary-700 focus:ring-primary-500 rounded" />
                      <span>En Oferta</span>
                    </label>
                    <label className="flex items-center cursor-pointer">
                      <input type="checkbox" className="mr-3 text-primary-700 focus:ring-primary-500 rounded" />
                      <span>Nuevo</span>
                    </label>
                    <label className="flex items-center cursor-pointer">
                      <input type="checkbox" className="mr-3 text-primary-700 focus:ring-primary-500 rounded" />
                      <span>Orgánico</span>
                    </label>
                  </div>
                </div>

                {/* Clear Filters */}
                <button
                  onClick={() => {
                    setSelectedCategory('all')
                    setPriceRange([0, 500])
                    setSearchTerm('')
                    setSortBy('featured')
                  }}
                  className="w-full py-2 px-4 bg-neutral-100 text-neutral-700 rounded-lg hover:bg-neutral-200 transition-colors"
                >
                  Limpiar Filtros
                </button>
              </div>
            </div>
          </aside>

          {/* Products Grid/List */}
          <div className="flex-1">
            {/* Results Count */}
            <div className="mb-6 flex items-center justify-between">
              <p className="text-neutral-600">
                Mostrando <span className="font-semibold text-neutral-900">{filteredProducts.length}</span> productos
              </p>
            </div>

            {loading ? (
              <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                {[...Array(6)].map((_, i) => (
                  <div key={i} className="bg-neutral-100 rounded-xl h-96 animate-pulse"></div>
                ))}
              </div>
            ) : filteredProducts.length === 0 ? (
              <div className="text-center py-12">
                <p className="text-xl text-neutral-600 mb-4">No se encontraron productos</p>
                <button
                  onClick={() => {
                    setSelectedCategory('all')
                    setPriceRange([0, 500])
                    setSearchTerm('')
                  }}
                  className="px-6 py-2 bg-primary-700 text-white rounded-lg hover:bg-primary-600 transition-colors"
                >
                  Ver todos los productos
                </button>
              </div>
            ) : viewMode === 'grid' ? (
              <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                {filteredProducts.map((product) => (
                  <div key={product.id} className="group bg-white rounded-xl shadow-soft hover:shadow-strong transition-all">
                    {/* Product Image */}
                    <div className="relative h-64 bg-gradient-to-br from-neutral-100 to-neutral-200 rounded-t-xl overflow-hidden">
                      {product.is_featured && (
                        <div className="absolute top-4 left-4 bg-secondary-500 text-white px-3 py-1 rounded-full text-sm font-semibold z-10">
                          Destacado
                        </div>
                      )}
                      <div className="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                      
                      {/* Quick Actions */}
                      <div className="absolute top-4 right-4 space-y-2 opacity-0 group-hover:opacity-100 transition-opacity">
                        <button className="p-2 bg-white rounded-full shadow-medium hover:bg-primary-50 transition-colors">
                          <Heart className="h-5 w-5 text-neutral-600 hover:text-primary-700" />
                        </button>
                      </div>
                    </div>

                    {/* Product Info */}
                    <div className="p-6">
                      <div className="mb-2">
                        <p className="text-sm text-neutral-500">{categories.find(c => c.id === product.category_id)?.name}</p>
                      </div>
                      <h3 className="text-xl font-semibold text-neutral-900 mb-2 group-hover:text-primary-700 transition-colors">
                        {product.name}
                      </h3>
                      <p className="text-neutral-600 text-sm mb-4 line-clamp-2">
                        {product.description}
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

                      {/* Price and Action */}
                      <div className="flex items-center justify-between">
                        <div>
                          <span className="text-2xl font-bold text-primary-700">Bs. {product.price}</span>
                          {product.unit && (
                            <span className="text-sm text-neutral-500 ml-1">/{product.unit}</span>
                          )}
                        </div>
                        <button className="p-2 bg-primary-700 text-white rounded-lg hover:bg-primary-600 transition-colors">
                          <ShoppingCart className="h-5 w-5" />
                        </button>
                      </div>
                    </div>
                  </div>
                ))}
              </div>
            ) : (
              <div className="space-y-4">
                {filteredProducts.map((product) => (
                  <div key={product.id} className="bg-white rounded-xl shadow-soft hover:shadow-medium transition-all p-6 flex gap-6">
                    {/* Product Image */}
                    <div className="w-48 h-48 bg-gradient-to-br from-neutral-100 to-neutral-200 rounded-lg flex-shrink-0"></div>
                    
                    {/* Product Info */}
                    <div className="flex-1">
                      <div className="mb-2">
                        <p className="text-sm text-neutral-500">{categories.find(c => c.id === product.category_id)?.name}</p>
                      </div>
                      <h3 className="text-2xl font-semibold text-neutral-900 mb-2">
                        {product.name}
                      </h3>
                      <p className="text-neutral-600 mb-4">
                        {product.description}
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

                      {/* Price and Actions */}
                      <div className="flex items-center justify-between">
                        <div>
                          <span className="text-3xl font-bold text-primary-700">Bs. {product.price}</span>
                          {product.unit && (
                            <span className="text-sm text-neutral-500 ml-1">/{product.unit}</span>
                          )}
                        </div>
                        <div className="flex gap-2">
                          <button className="p-2 bg-neutral-100 text-neutral-600 rounded-lg hover:bg-neutral-200 transition-colors">
                            <Heart className="h-5 w-5" />
                          </button>
                          <button className="px-6 py-2 bg-primary-700 text-white rounded-lg hover:bg-primary-600 transition-colors flex items-center gap-2">
                            <ShoppingCart className="h-5 w-5" />
                            Agregar al Carrito
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                ))}
              </div>
            )}

            {/* Pagination */}
            {filteredProducts.length > 0 && (
              <div className="mt-12 flex justify-center">
                <nav className="flex gap-2">
                  <button className="px-4 py-2 bg-neutral-100 text-neutral-600 rounded-lg hover:bg-neutral-200 transition-colors">
                    Anterior
                  </button>
                  <button className="px-4 py-2 bg-primary-700 text-white rounded-lg">
                    1
                  </button>
                  <button className="px-4 py-2 bg-neutral-100 text-neutral-600 rounded-lg hover:bg-neutral-200 transition-colors">
                    2
                  </button>
                  <button className="px-4 py-2 bg-neutral-100 text-neutral-600 rounded-lg hover:bg-neutral-200 transition-colors">
                    3
                  </button>
                  <button className="px-4 py-2 bg-neutral-100 text-neutral-600 rounded-lg hover:bg-neutral-200 transition-colors">
                    Siguiente
                  </button>
                </nav>
              </div>
            )}
          </div>
        </div>
      </div>
    </Layout>
  )
}
