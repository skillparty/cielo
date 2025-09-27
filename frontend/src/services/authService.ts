import { api } from '@/lib/api'
import { User } from '@/types'

export interface LoginData {
  email: string
  password: string
}

export interface RegisterData {
  name: string
  email: string
  password: string
  password_confirmation: string
  phone?: string
}

export interface AuthResponse {
  user: User
  token: string
}

export const authService = {
  // Login user
  async login(data: LoginData): Promise<AuthResponse> {
    const response = await api.post('/auth/login', data)
    const { user, token } = response.data.data
    
    // Store token in localStorage
    if (typeof window !== 'undefined') {
      localStorage.setItem('auth_token', token)
    }
    
    return { user, token }
  },

  // Register user
  async register(data: RegisterData): Promise<AuthResponse> {
    const response = await api.post('/auth/register', data)
    const { user, token } = response.data.data
    
    // Store token in localStorage
    if (typeof window !== 'undefined') {
      localStorage.setItem('auth_token', token)
    }
    
    return { user, token }
  },

  // Logout user
  async logout(): Promise<void> {
    try {
      await api.post('/auth/logout')
    } catch (error) {
      // Even if the API call fails, we should clear local storage
      console.error('Logout API call failed:', error)
    } finally {
      if (typeof window !== 'undefined') {
        localStorage.removeItem('auth_token')
      }
    }
  },

  // Get current user
  async getCurrentUser(): Promise<User> {
    const response = await api.get('/auth/user')
    return response.data.data
  },

  // Check if user is authenticated
  isAuthenticated(): boolean {
    if (typeof window === 'undefined') return false
    return !!localStorage.getItem('auth_token')
  },

  // Get stored token
  getToken(): string | null {
    if (typeof window === 'undefined') return null
    return localStorage.getItem('auth_token')
  }
}
