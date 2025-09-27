export default function LocationMap() {
  return (
    <section className="py-16 bg-gray-50">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="text-center mb-8">
          <h2 className="text-3xl font-bold text-gray-900 mb-4">
            Nuestra Ubicación
          </h2>
          <p className="text-gray-600">
            Visítanos en nuestra tienda principal en La Paz
          </p>
        </div>

        <div className="bg-white rounded-2xl shadow-lg overflow-hidden">
          {/* Map Placeholder */}
          <div className="aspect-video bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
            <div className="text-center">
              <div className="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg className="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                  <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
              </div>
              <h3 className="text-xl font-semibold text-gray-900 mb-2">
                Cielo Carnes - Tienda Principal
              </h3>
              <p className="text-gray-600 mb-4">
                Av. Principal 123, Sopocachi<br />
                La Paz, Bolivia
              </p>
              <button className="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 transition-colors">
                Ver en Google Maps
              </button>
            </div>
          </div>

          {/* Location Info */}
          <div className="p-6 border-t border-gray-200">
            <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
              <div className="text-center">
                <div className="text-2xl font-bold text-red-600 mb-1">15 min</div>
                <div className="text-sm text-gray-600">Desde el centro de La Paz</div>
              </div>
              <div className="text-center">
                <div className="text-2xl font-bold text-red-600 mb-1">🚗</div>
                <div className="text-sm text-gray-600">Estacionamiento disponible</div>
              </div>
              <div className="text-center">
                <div className="text-2xl font-bold text-red-600 mb-1">🚌</div>
                <div className="text-sm text-gray-600">Acceso en transporte público</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  )
}
