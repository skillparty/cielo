import { api } from '@/lib/api'
import { Category } from '@/types'

export const categoryService = {
  // Get all categories
  async getCategories(): Promise<Category[]> {
    const response = await api.get('/categories')
    return response.data.data
  },

  // Get single category
  async getCategory(id: string): Promise<Category> {
    const response = await api.get(`/categories/${id}`)
    return response.data.data
  }
}
