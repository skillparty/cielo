export default function LocationMap() {
  return (
    <section className="py-12 sm:py-16 bg-neutral-50 w-full">
      <div className="w-full mx-auto px-3 sm:px-4 md:px-6 lg:px-8 xl:px-12 2xl:px-16">
        <div className="text-center mb-6 sm:mb-8">
          <h2 className="text-2xl sm:text-3xl font-display font-bold text-neutral-900 mb-3 sm:mb-4">
            Nuestra Ubicación
          </h2>
          <p className="text-sm sm:text-base text-neutral-600">
            Visítanos en nuestra tienda principal en La Paz
          </p>
        </div>

        <div className="bg-white rounded-2xl shadow-medium overflow-hidden">
          {/* Map Placeholder */}
          <div className="aspect-video bg-gradient-to-br from-neutral-100 to-neutral-200 flex items-center justify-center">
            <div className="text-center px-4">
              <div className="w-12 h-12 sm:w-16 sm:h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-3 sm:mb-4">
                <svg className="w-6 h-6 sm:w-8 sm:h-8 text-primary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                  <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
              </div>
              <h3 className="text-lg sm:text-xl font-semibold text-neutral-900 mb-2">
                Cielo Carnes - Tienda Principal
              </h3>
              <p className="text-sm sm:text-base text-neutral-600 mb-3 sm:mb-4">
                Av. Principal 123, Sopocachi<br />
                La Paz, Bolivia
              </p>
              <button className="bg-primary-700 text-white px-4 sm:px-6 py-2 rounded-lg hover:bg-primary-600 transition-colors text-sm sm:text-base">
                Ver en Google Maps
              </button>
            </div>
          </div>

          {/* Location Info */}
          <div className="p-4 sm:p-6 border-t border-neutral-200">
            <div className="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6">
              <div className="text-center">
                <div className="text-xl sm:text-2xl font-bold text-primary-700 mb-1">15 min</div>
                <div className="text-xs sm:text-sm text-neutral-600">Desde el centro de La Paz</div>
              </div>
              <div className="text-center">
                <div className="text-xl sm:text-2xl font-bold text-primary-700 mb-1">🚗</div>
                <div className="text-xs sm:text-sm text-neutral-600">Estacionamiento disponible</div>
              </div>
              <div className="text-center">
                <div className="text-xl sm:text-2xl font-bold text-primary-700 mb-1">🚌</div>
                <div className="text-xs sm:text-sm text-neutral-600">Acceso en transporte público</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  )
}
