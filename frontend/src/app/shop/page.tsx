import Layout from '@/components/layout/Layout'
import ShopHero from '@/components/shop/ShopHero'
import ProductGrid from '@/components/shop/ProductGrid'
import CategoryFilter from '@/components/shop/CategoryFilter'

export default function ShopPage() {
  return (
    <Layout>
      <ShopHero />
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div className="flex flex-col lg:flex-row gap-8">
          <aside className="lg:w-64">
            <CategoryFilter />
          </aside>
          <main className="flex-1">
            <ProductGrid />
          </main>
        </div>
      </div>
    </Layout>
  )
}
