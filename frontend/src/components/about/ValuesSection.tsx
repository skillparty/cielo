import { ShieldCheckIcon, HeartIcon, StarIcon, TruckIcon } from '@heroicons/react/24/outline'

const values = [
  {
    icon: ShieldCheckIcon,
    title: 'Calidad Garantizada',
    description: 'Rigurosos controles de calidad en cada etapa del proceso, desde la selección hasta la entrega.'
  },
  {
    icon: HeartIcon,
    title: 'Pasión Familiar',
    description: 'Más de 20 años de tradición familiar, transmitiendo conocimiento y amor por nuestro trabajo.'
  },
  {
    icon: StarIcon,
    title: 'Excelencia',
    description: 'Búsqueda constante de la perfección en productos y servicios para superar expectativas.'
  },
  {
    icon: TruckIcon,
    title: 'Servicio Confiable',
    description: 'Entrega puntual y segura, manteniendo la cadena de frío para preservar la frescura.'
  }
]

export default function ValuesSection() {
  return (
    <section className="py-12 sm:py-16 bg-neutral-50 w-full">
      <div className="w-full mx-auto px-3 sm:px-4 md:px-6 lg:px-8 xl:px-12 2xl:px-16">
        <div className="text-center mb-8 sm:mb-12">
          <h2 className="text-2xl sm:text-3xl md:text-4xl font-display font-bold text-neutral-900 mb-3 sm:mb-4">
            Nuestros Valores
          </h2>
          <p className="text-base sm:text-lg md:text-xl text-neutral-600 max-w-2xl mx-auto px-4">
            Los principios que guían cada decisión y acción en Cielo Carnes
          </p>
        </div>

        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8">
          {values.map((value, index) => (
            <div key={index} className="text-center group">
              <div className="w-12 h-12 sm:w-14 sm:h-14 md:w-16 md:h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-3 sm:mb-4 group-hover:bg-primary-200 transition-colors">
                <value.icon className="h-6 w-6 sm:h-7 sm:w-7 md:h-8 md:w-8 text-primary-700" />
              </div>
              <h3 className="text-lg sm:text-xl font-semibold text-neutral-900 mb-2 sm:mb-3">
                {value.title}
              </h3>
              <p className="text-sm sm:text-base text-neutral-600 leading-relaxed">
                {value.description}
              </p>
            </div>
          ))}
        </div>

        {/* Stats */}
        <div className="mt-12 sm:mt-16 grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6 md:gap-8 text-center">
          <div>
            <div className="text-2xl sm:text-3xl md:text-4xl font-bold text-primary-700 mb-1 sm:mb-2">20+</div>
            <div className="text-xs sm:text-sm md:text-base text-neutral-600">Años de Experiencia</div>
          </div>
          <div>
            <div className="text-2xl sm:text-3xl md:text-4xl font-bold text-primary-700 mb-1 sm:mb-2">1000+</div>
            <div className="text-xs sm:text-sm md:text-base text-neutral-600">Clientes Satisfechos</div>
          </div>
          <div>
            <div className="text-2xl sm:text-3xl md:text-4xl font-bold text-primary-700 mb-1 sm:mb-2">50+</div>
            <div className="text-xs sm:text-sm md:text-base text-neutral-600">Productos Disponibles</div>
          </div>
          <div>
            <div className="text-2xl sm:text-3xl md:text-4xl font-bold text-primary-700 mb-1 sm:mb-2">100%</div>
            <div className="text-xs sm:text-sm md:text-base text-neutral-600">Calidad Garantizada</div>
          </div>
        </div>
      </div>
    </section>
  )
}
