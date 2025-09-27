export default function AboutHero() {
  return (
    <section className="relative bg-gradient-to-r from-red-600 to-red-800 text-white py-24">
      <div className="absolute inset-0 bg-black opacity-30"></div>
      <div className="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 className="text-4xl md:text-6xl font-bold mb-6">
          Nuestra Historia
        </h1>
        <p className="text-xl md:text-2xl text-red-100 max-w-3xl mx-auto">
          Más de 20 años dedicados a ofrecer carnes y fiambres de la más alta calidad, 
          manteniendo la tradición familiar boliviana.
        </p>
      </div>
    </section>
  )
}
