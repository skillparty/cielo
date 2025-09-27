import axios from 'axios'

const API_BASE_URL = process.env.NEXT_PUBLIC_API_URL || 'http://localhost:8000/api/v1'

export const api = axios.create({
  baseURL: API_BASE_URL,
  headers: {
    'Content-Type': 'application/json',
    'Accept': 'application/json',
  },
})

// Request interceptor to add auth token and session ID
api.interceptors.request.use((config) => {
  // Add auth token if available
  const token = typeof window !== 'undefined' ? localStorage.getItem('auth_token') : null
  if (token) {
    config.headers.Authorization = `Bearer ${token}`
  }
  
  // Add session ID for cart functionality
  let sessionId = typeof window !== 'undefined' ? localStorage.getItem('session_id') : null
  if (!sessionId && typeof window !== 'undefined') {
    sessionId = 'guest_' + Math.random().toString(36).substr(2, 9) + Date.now().toString(36)
    localStorage.setItem('session_id', sessionId)
  }
  if (sessionId) {
    config.headers['X-Session-ID'] = sessionId
  }
  
  return config
})

// Response interceptor for error handling
api.interceptors.response.use(
  (response) => response,
  (error) => {
    if (error.response?.status === 401 && typeof window !== 'undefined') {
      localStorage.removeItem('auth_token')
      window.location.href = '/login'
    }
    return Promise.reject(error)
  }
)

// API endpoints
export const endpoints = {
  // Products
  products: '/products',
  productsByCategory: (categoryId: string) => `/products/category/${categoryId}`,
  product: (id: string) => `/products/${id}`,
  
  // Categories
  categories: '/categories',
  
  // Cart
  cart: '/cart',
  addToCart: '/cart/add',
  updateCart: '/cart/update',
  removeFromCart: '/cart/remove',
  
  // Orders
  orders: '/orders',
  order: (id: string) => `/orders/${id}`,
  
  // Auth
  login: '/auth/login',
  register: '/auth/register',
  logout: '/auth/logout',
  profile: '/auth/profile',
  
  // Contact
  contact: '/contact',
  
  // Recipes
  recipes: '/recipes',
  recipesFeatured: '/recipes/featured',
  recipe: (id: string) => `/recipes/${id}`,
  recipesByDifficulty: (difficulty: number) => `/recipes/difficulty/${difficulty}`,
}
