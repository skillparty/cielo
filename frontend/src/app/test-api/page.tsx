'use client'

import { useEffect, useState } from 'react'
import { productService } from '@/services/productService'
import { categoryService } from '@/services/categoryService'
import Layout from '@/components/layout/Layout'

export default function TestApiPage() {
  const [products, setProducts] = useState([])
  const [categories, setCategories] = useState([])
  const [loading, setLoading] = useState(true)
  const [error, setError] = useState('')

  useEffect(() => {
    const testApi = async () => {
      try {
        setLoading(true)
        
        // Test products API
        const productsResponse = await productService.getFeaturedProducts()
        setProducts(productsResponse)
        
        // Test categories API
        const categoriesResponse = await categoryService.getCategories()
        setCategories(categoriesResponse)
        
        setLoading(false)
      } catch (err) {
        setError('Error connecting to API: ' + (err as Error).message)
        setLoading(false)
      }
    }

    testApi()
  }, [])

  return (
    <Layout>
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h1 className="text-3xl font-bold mb-8">API Connection Test</h1>
        
        {loading && (
          <div className="text-center">
            <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-red-600 mx-auto mb-4"></div>
            <p>Testing API connection...</p>
          </div>
        )}

        {error && (
          <div className="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {error}
          </div>
        )}

        {!loading && !error && (
          <div className="space-y-8">
            {/* Categories */}
            <div>
              <h2 className="text-2xl font-semibold mb-4">Categories ({categories.length})</h2>
              <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
                {categories.map((category: any) => (
                  <div key={category.id} className="bg-white p-4 rounded-lg shadow border">
                    <h3 className="font-semibold">{category.name}</h3>
                    <p className="text-sm text-gray-600">{category.description}</p>
                    <p className="text-xs text-gray-500 mt-2">Products: {category.products_count || 0}</p>
                  </div>
                ))}
              </div>
            </div>

            {/* Products */}
            <div>
              <h2 className="text-2xl font-semibold mb-4">Featured Products ({products.length})</h2>
              <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                {products.map((product: any) => (
                  <div key={product.id} className="bg-white p-4 rounded-lg shadow border">
                    <h3 className="font-semibold">{product.name}</h3>
                    <p className="text-sm text-gray-600 mb-2">{product.subtitle}</p>
                    <p className="text-lg font-bold text-red-600">Bs. {product.base_price}</p>
                    <p className="text-xs text-gray-500">Stock: {product.stock} {product.unit_type}</p>
                    <p className="text-xs text-gray-500">Category: {product.category?.name}</p>
                  </div>
                ))}
              </div>
            </div>

            {/* Success Message */}
            <div className="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
              ✅ API connection successful! Frontend is properly connected to Laravel backend.
            </div>
          </div>
        )}
      </div>
    </Layout>
  )
}
