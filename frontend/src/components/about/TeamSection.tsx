const team = [
  {
    name: 'Carlos Mendoza',
    role: 'Fundador y Director General',
    description: 'Con más de 25 años de experiencia en la industria cárnica, Carlos fundó Cielo Carnes con la visión de ofrecer productos de calidad excepcional.',
    image: '/images/team/carlos.jpg'
  },
  {
    name: 'María Gonzales',
    role: 'Directora de Calidad',
    description: 'Especialista en seguridad alimentaria, María supervisa todos los procesos de calidad y garantiza los más altos estándares.',
    image: '/images/team/maria.jpg'
  },
  {
    name: 'Roberto Silva',
    role: 'Maestro Carnicero',
    description: 'Con 20 años de experiencia, Roberto es experto en cortes especiales y selección de las mejores piezas de carne.',
    image: '/images/team/roberto.jpg'
  },
  {
    name: 'Ana Vargas',
    role: 'Atención al Cliente',
    description: 'Ana se encarga de brindar el mejor servicio a nuestros clientes, asegurando que cada experiencia sea excepcional.',
    image: '/images/team/ana.jpg'
  }
]

export default function TeamSection() {
  return (
    <section className="py-16 bg-white">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="text-center mb-12">
          <h2 className="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
            Nuestro Equipo
          </h2>
          <p className="text-xl text-gray-600 max-w-2xl mx-auto">
            Conoce a las personas apasionadas que hacen posible la excelencia de Cielo Carnes
          </p>
        </div>

        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
          {team.map((member, index) => (
            <div key={index} className="text-center group">
              {/* Photo */}
              <div className="relative w-32 h-32 mx-auto mb-4 overflow-hidden rounded-full bg-gradient-to-br from-red-100 to-red-200">
                <div className="w-full h-full flex items-center justify-center">
                  <span className="text-4xl">👤</span>
                </div>
              </div>

              {/* Info */}
              <h3 className="text-xl font-semibold text-gray-900 mb-1">
                {member.name}
              </h3>
              <p className="text-red-600 font-medium mb-3">
                {member.role}
              </p>
              <p className="text-gray-600 text-sm leading-relaxed">
                {member.description}
              </p>
            </div>
          ))}
        </div>

        {/* Call to Action */}
        <div className="mt-16 text-center">
          <div className="bg-gradient-to-r from-red-600 to-red-800 rounded-2xl p-8 text-white">
            <h3 className="text-2xl md:text-3xl font-bold mb-4">
              ¿Quieres formar parte de nuestro equipo?
            </h3>
            <p className="text-red-100 mb-6 max-w-2xl mx-auto">
              Siempre estamos buscando personas apasionadas que compartan nuestros valores 
              de calidad y excelencia en el servicio.
            </p>
            <button className="bg-white text-red-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
              Ver Oportunidades
            </button>
          </div>
        </div>
      </div>
    </section>
  )
}
