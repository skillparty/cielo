import { api } from '@/lib/api'
import { Cart, CartItem } from '@/types'

export interface AddToCartData {
  product_id: string
  quantity: number
}

export interface UpdateCartData {
  quantity: number
}

export const cartService = {
  // Get cart contents
  async getCart(): Promise<Cart> {
    const response = await api.get('/cart')
    return response.data.data
  },

  // Add item to cart
  async addToCart(data: AddToCartData): Promise<CartItem> {
    const response = await api.post('/cart', data)
    return response.data.data
  },

  // Update cart item
  async updateCartItem(id: string, data: UpdateCartData): Promise<CartItem> {
    const response = await api.put(`/cart/${id}`, data)
    return response.data.data
  },

  // Remove item from cart
  async removeFromCart(id: string): Promise<void> {
    await api.delete(`/cart/${id}`)
  },

  // Clear entire cart
  async clearCart(): Promise<void> {
    await api.delete('/cart')
  },

  // Get cart count
  async getCartCount(): Promise<number> {
    const response = await api.get('/cart/count')
    return response.data.count
  }
}
