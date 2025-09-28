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
    <section className="py-12 sm:py-16 bg-white w-full">
      <div className="w-full mx-auto px-3 sm:px-4 md:px-6 lg:px-8 xl:px-12 2xl:px-16">
        <div className="text-center mb-8 sm:mb-12">
          <h2 className="text-2xl sm:text-3xl md:text-4xl font-display font-bold text-neutral-900 mb-3 sm:mb-4">
            Nuestro Equipo
          </h2>
          <p className="text-base sm:text-lg md:text-xl text-neutral-600 max-w-2xl mx-auto px-4">
            Conoce a las personas apasionadas que hacen posible la excelencia de Cielo Carnes
          </p>
        </div>

        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8">
          {team.map((member, index) => (
            <div key={index} className="text-center group">
              {/* Photo */}
              <div className="relative w-24 h-24 sm:w-28 sm:h-28 md:w-32 md:h-32 mx-auto mb-3 sm:mb-4 overflow-hidden rounded-full bg-gradient-to-br from-primary-100 to-secondary-100">
                <div className="w-full h-full flex items-center justify-center">
                  <span className="text-2xl sm:text-3xl md:text-4xl">👤</span>
                </div>
              </div>

              {/* Info */}
              <h3 className="text-lg sm:text-xl font-semibold text-neutral-900 mb-1">
                {member.name}
              </h3>
              <p className="text-primary-700 font-medium mb-2 sm:mb-3 text-sm sm:text-base">
                {member.role}
              </p>
              <p className="text-neutral-600 text-xs sm:text-sm leading-relaxed">
                {member.description}
              </p>
            </div>
          ))}
        </div>

        {/* Call to Action */}
        <div className="mt-12 sm:mt-16 text-center">
          <div className="bg-gradient-to-r from-primary-700 to-primary-900 rounded-2xl p-6 sm:p-8 text-white">
            <h3 className="text-xl sm:text-2xl md:text-3xl font-display font-bold mb-3 sm:mb-4">
              ¿Quieres formar parte de nuestro equipo?
            </h3>
            <p className="text-primary-100 mb-4 sm:mb-6 max-w-2xl mx-auto text-sm sm:text-base px-4">
              Siempre estamos buscando personas apasionadas que compartan nuestros valores 
              de calidad y excelencia en el servicio.
            </p>
            <button className="bg-white text-primary-700 px-6 sm:px-8 py-2.5 sm:py-3 rounded-lg font-semibold hover:bg-neutral-100 transition-colors text-sm sm:text-base">
              Ver Oportunidades
            </button>
          </div>
        </div>
      </div>
    </section>
  )
}
