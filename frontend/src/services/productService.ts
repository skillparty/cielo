import { api } from '@/lib/api'
import { Product, Category } from '@/types'

export interface ProductFilters {
  category_id?: string
  featured?: boolean
  min_price?: number
  max_price?: number
  search?: string
  sort?: 'name' | 'price_asc' | 'price_desc' | 'featured'
  page?: number
  per_page?: number
}

export interface ProductsResponse {
  data: Product[]
  meta: {
    current_page: number
    last_page: number
    per_page: number
    total: number
  }
}

export const productService = {
  // Get all products with filters
  async getProducts(filters: ProductFilters = {}): Promise<ProductsResponse> {
    const response = await api.get('/products', { params: filters })
    return response.data
  },

  // Get featured products
  async getFeaturedProducts(): Promise<Product[]> {
    const response = await api.get('/products/featured')
    return response.data.data
  },

  // Get single product
  async getProduct(id: string): Promise<Product> {
    const response = await api.get(`/products/${id}`)
    return response.data.data
  },

  // Get products by category
  async getProductsByCategory(categoryId: string): Promise<ProductsResponse & { category: Category }> {
    const response = await api.get(`/products/category/${categoryId}`)
    return response.data
  }
}
