'use client'

import { useState, useEffect } from 'react'
import { cartService } from '@/services/cartService'
import { Cart } from '@/types'

export function useCart() {
  const [cart, setCart] = useState<Cart>({ items: [], total: 0, count: 0 })
  const [loading, setLoading] = useState(true)
  const [error, setError] = useState<string | null>(null)

  const fetchCart = async () => {
    try {
      setLoading(true)
      setError(null)
      const data = await cartService.getCart()
      setCart(data)
    } catch (err) {
      setError('Error al cargar el carrito')
      console.error('Error fetching cart:', err)
    } finally {
      setLoading(false)
    }
  }

  const addToCart = async (productId: string, quantity: number) => {
    try {
      await cartService.addToCart({ product_id: productId, quantity })
      await fetchCart() // Refresh cart
      return true
    } catch (err) {
      setError('Error al agregar producto al carrito')
      console.error('Error adding to cart:', err)
      return false
    }
  }

  const updateCartItem = async (itemId: string, quantity: number) => {
    try {
      if (quantity === 0) {
        await cartService.removeFromCart(itemId)
      } else {
        await cartService.updateCartItem(itemId, { quantity })
      }
      await fetchCart() // Refresh cart
      return true
    } catch (err) {
      setError('Error al actualizar el carrito')
      console.error('Error updating cart:', err)
      return false
    }
  }

  const removeFromCart = async (itemId: string) => {
    try {
      await cartService.removeFromCart(itemId)
      await fetchCart() // Refresh cart
      return true
    } catch (err) {
      setError('Error al eliminar producto del carrito')
      console.error('Error removing from cart:', err)
      return false
    }
  }

  const clearCart = async () => {
    try {
      await cartService.clearCart()
      await fetchCart() // Refresh cart
      return true
    } catch (err) {
      setError('Error al vaciar el carrito')
      console.error('Error clearing cart:', err)
      return false
    }
  }

  useEffect(() => {
    fetchCart()
  }, [])

  return {
    cart,
    loading,
    error,
    addToCart,
    updateCartItem,
    removeFromCart,
    clearCart,
    refreshCart: fetchCart
  }
}
