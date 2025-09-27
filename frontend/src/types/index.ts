export interface Product {
  id: string
  category_id: string
  sku: string
  slug: string
  name: string
  subtitle?: string
  description: string
  preparation_tips?: string
  base_price: number
  promo_price?: number
  unit_type: string
  unit_quantity: number
  stock: number
  safety_stock: number
  is_featured: boolean
  is_active: boolean
  nutrition_facts?: any
  metadata?: any
  category?: Category
  media?: any[]
  created_at: string
  updated_at: string
}

export interface Category {
  id: string
  parent_id?: string
  slug: string
  name: string
  description?: string
  display_order: number
  is_active: boolean
  products_count?: number
  media?: any[]
  parent?: Category
  children?: Category[]
  created_at: string
  updated_at: string
}

export interface CartItem {
  id: string
  product_id: string
  product: Product
  quantity: number
  price: number
  total: number
}

export interface Cart {
  items: CartItem[]
  total: number
  count: number
}

export interface User {
  id: string
  name: string
  email: string
  phone?: string
  address?: string
  created_at: string
  updated_at: string
}

export interface Order {
  id: string
  user_id: string
  user?: User
  items: OrderItem[]
  total: number
  status: 'pending' | 'processing' | 'shipped' | 'delivered' | 'cancelled'
  shipping_address: string
  payment_method: string
  created_at: string
  updated_at: string
}

export interface OrderItem {
  id: string
  order_id: string
  product_id: string
  product: Product
  quantity: number
  price: number
  total: number
}

export interface Recipe {
  id: string
  category_id: string
  slug: string
  title: string
  subtitle?: string
  summary: string
  instructions: string
  prep_time_minutes: number
  cook_time_minutes: number
  difficulty_level: number
  servings: number
  video_url?: string
  cover_image?: string
  nutrition_facts?: any
  metadata?: any
  is_published: boolean
  published_at: string
  category?: Category
  products?: Product[]
  media?: any[]
  created_at: string
  updated_at: string
}

export interface ContactForm {
  name: string
  email: string
  phone?: string
  subject: string
  message: string
}
