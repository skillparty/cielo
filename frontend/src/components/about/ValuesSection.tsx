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
    <section className="py-16 bg-gray-50">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="text-center mb-12">
          <h2 className="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
            Nuestros Valores
          </h2>
          <p className="text-xl text-gray-600 max-w-2xl mx-auto">
            Los principios que guían cada decisión y acción en Cielo Carnes
          </p>
        </div>

        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
          {values.map((value, index) => (
            <div key={index} className="text-center group">
              <div className="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-red-200 transition-colors">
                <value.icon className="h-8 w-8 text-red-600" />
              </div>
              <h3 className="text-xl font-semibold text-gray-900 mb-3">
                {value.title}
              </h3>
              <p className="text-gray-600 leading-relaxed">
                {value.description}
              </p>
            </div>
          ))}
        </div>

        {/* Stats */}
        <div className="mt-16 grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
          <div>
            <div className="text-4xl font-bold text-red-600 mb-2">20+</div>
            <div className="text-gray-600">Años de Experiencia</div>
          </div>
          <div>
            <div className="text-4xl font-bold text-red-600 mb-2">1000+</div>
            <div className="text-gray-600">Clientes Satisfechos</div>
          </div>
          <div>
            <div className="text-4xl font-bold text-red-600 mb-2">50+</div>
            <div className="text-gray-600">Productos Disponibles</div>
          </div>
          <div>
            <div className="text-4xl font-bold text-red-600 mb-2">100%</div>
            <div className="text-gray-600">Calidad Garantizada</div>
          </div>
        </div>
      </div>
    </section>
  )
}
