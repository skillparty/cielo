'use client'

import { useState, useEffect } from 'react'
import { productService, ProductFilters } from '@/services/productService'
import { Product } from '@/types'

export function useProducts(filters: ProductFilters = {}) {
  const [products, setProducts] = useState<Product[]>([])
  const [loading, setLoading] = useState(true)
  const [error, setError] = useState<string | null>(null)
  const [meta, setMeta] = useState({
    current_page: 1,
    last_page: 1,
    per_page: 12,
    total: 0
  })

  useEffect(() => {
    const fetchProducts = async () => {
      try {
        setLoading(true)
        setError(null)
        const response = await productService.getProducts(filters)
        setProducts(response.data)
        setMeta(response.meta)
      } catch (err) {
        setError('Error al cargar los productos')
        console.error('Error fetching products:', err)
      } finally {
        setLoading(false)
      }
    }

    fetchProducts()
  }, [JSON.stringify(filters)])

  return { products, loading, error, meta }
}

export function useFeaturedProducts() {
  const [products, setProducts] = useState<Product[]>([])
  const [loading, setLoading] = useState(true)
  const [error, setError] = useState<string | null>(null)

  useEffect(() => {
    const fetchFeaturedProducts = async () => {
      try {
        setLoading(true)
        setError(null)
        const data = await productService.getFeaturedProducts()
        setProducts(data)
      } catch (err) {
        setError('Error al cargar los productos destacados')
        console.error('Error fetching featured products:', err)
      } finally {
        setLoading(false)
      }
    }

    fetchFeaturedProducts()
  }, [])

  return { products, loading, error }
}

export function useProduct(id: string) {
  const [product, setProduct] = useState<Product | null>(null)
  const [loading, setLoading] = useState(true)
  const [error, setError] = useState<string | null>(null)

  useEffect(() => {
    if (!id) return

    const fetchProduct = async () => {
      try {
        setLoading(true)
        setError(null)
        const data = await productService.getProduct(id)
        setProduct(data)
      } catch (err) {
        setError('Error al cargar el producto')
        console.error('Error fetching product:', err)
      } finally {
        setLoading(false)
      }
    }

    fetchProduct()
  }, [id])

  return { product, loading, error }
}
