export default function OurStory() {
  return (
    <section className="py-12 sm:py-16 bg-white w-full">
      <div className="w-full mx-auto px-3 sm:px-4 md:px-6 lg:px-8 xl:px-12 2xl:px-16">
        <div className="grid grid-cols-1 lg:grid-cols-2 gap-8 sm:gap-12 items-center">
          {/* Content */}
          <div>
            <h2 className="text-2xl sm:text-3xl md:text-4xl font-display font-bold text-neutral-900 mb-4 sm:mb-6">
              Tradición Familiar desde 2003
            </h2>
            <div className="space-y-3 sm:space-y-4 text-base sm:text-lg text-neutral-600">
              <p>
                Cielo Carnes nació en 2003 como un sueño familiar en La Paz, Bolivia. 
                Comenzamos como un pequeño negocio local con la visión de ofrecer 
                productos cárnicos de la más alta calidad a las familias bolivianas.
              </p>
              <p>
                A lo largo de los años, hemos mantenido nuestro compromiso con la 
                excelencia, seleccionando cuidadosamente cada producto y manteniendo 
                los más altos estándares de calidad e higiene.
              </p>
              <p>
                Hoy, después de más de dos décadas, nos enorgullecemos de ser una 
                empresa familiar que ha crecido junto con nuestros clientes, 
                siempre manteniendo los valores que nos fundaron: calidad, 
                confianza y servicio excepcional.
              </p>
            </div>
          </div>

          {/* Timeline */}
          <div className="relative">
            <div className="absolute left-3 sm:left-4 top-0 bottom-0 w-0.5 bg-primary-200"></div>
            <div className="space-y-8">
              {[
                { year: '2003', title: 'Fundación', desc: 'Inicio como negocio familiar en La Paz' },
                { year: '2008', title: 'Expansión', desc: 'Ampliación de productos y servicios' },
                { year: '2015', title: 'Modernización', desc: 'Implementación de nuevas tecnologías' },
                { year: '2020', title: 'Digitalización', desc: 'Lanzamiento de tienda online' },
                { year: '2024', title: 'Presente', desc: 'Líder en calidad y servicio' }
              ].map((milestone, index) => (
                <div key={index} className="relative flex items-start">
                  <div className="flex-shrink-0 w-6 h-6 sm:w-8 sm:h-8 bg-primary-700 rounded-full flex items-center justify-center">
                    <div className="w-2 h-2 sm:w-3 sm:h-3 bg-white rounded-full"></div>
                  </div>
                  <div className="ml-3 sm:ml-4">
                    <div className="text-primary-700 font-bold text-base sm:text-lg">{milestone.year}</div>
                    <div className="font-semibold text-neutral-900 text-sm sm:text-base">{milestone.title}</div>
                    <div className="text-neutral-600 text-sm sm:text-base">{milestone.desc}</div>
                  </div>
                </div>
              ))}
            </div>
          </div>
        </div>
      </div>
    </section>
  )
}
