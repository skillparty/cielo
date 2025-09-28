export default function AboutHero() {
  return (
    <section className="relative bg-gradient-to-r from-primary-900 to-primary-700 text-white py-16 sm:py-20 md:py-24 w-full">
      <div className="absolute inset-0 bg-black opacity-30"></div>
      <div className="relative w-full mx-auto px-3 sm:px-4 md:px-6 lg:px-8 xl:px-12 2xl:px-16 text-center">
        <h1 className="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-display font-bold mb-4 sm:mb-6 leading-tight">
          Nuestra Historia
        </h1>
        <p className="text-base sm:text-lg md:text-xl lg:text-2xl text-primary-100 max-w-4xl mx-auto leading-relaxed">
          Más de 20 años dedicados a ofrecer carnes y fiambres de la más alta calidad, 
          manteniendo la tradición familiar boliviana.
        </p>
      </div>
    </section>
  )
}
