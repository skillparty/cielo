export default function RecipeHero() {
  return (
    <section className="bg-gradient-to-r from-red-600 to-red-800 text-white py-20">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 className="text-4xl md:text-6xl font-bold mb-6">
          Recetas Deliciosas
        </h1>
        <p className="text-xl md:text-2xl text-red-100 max-w-3xl mx-auto mb-8">
          Descubre recetas increíbles usando nuestros productos premium. 
          Desde platos tradicionales hasta creaciones modernas.
        </p>
        <div className="flex flex-wrap justify-center gap-4 text-sm">
          <div className="bg-red-500 bg-opacity-50 px-4 py-2 rounded-full">
            🍽️ Más de 50 recetas
          </div>
          <div className="bg-red-500 bg-opacity-50 px-4 py-2 rounded-full">
            👨‍🍳 Paso a paso
          </div>
          <div className="bg-red-500 bg-opacity-50 px-4 py-2 rounded-full">
            ⭐ Todos los niveles
          </div>
        </div>
      </div>
    </section>
  )
}
