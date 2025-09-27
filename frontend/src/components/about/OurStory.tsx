export default function OurStory() {
  return (
    <section className="py-16 bg-white">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
          {/* Content */}
          <div>
            <h2 className="text-3xl md:text-4xl font-bold text-gray-900 mb-6">
              Tradición Familiar desde 2003
            </h2>
            <div className="space-y-4 text-lg text-gray-600">
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
            <div className="absolute left-4 top-0 bottom-0 w-0.5 bg-red-200"></div>
            <div className="space-y-8">
              {[
                { year: '2003', title: 'Fundación', desc: 'Inicio como negocio familiar en La Paz' },
                { year: '2008', title: 'Expansión', desc: 'Ampliación de productos y servicios' },
                { year: '2015', title: 'Modernización', desc: 'Implementación de nuevas tecnologías' },
                { year: '2020', title: 'Digitalización', desc: 'Lanzamiento de tienda online' },
                { year: '2024', title: 'Presente', desc: 'Líder en calidad y servicio' }
              ].map((milestone, index) => (
                <div key={index} className="relative flex items-start">
                  <div className="flex-shrink-0 w-8 h-8 bg-red-600 rounded-full flex items-center justify-center">
                    <div className="w-3 h-3 bg-white rounded-full"></div>
                  </div>
                  <div className="ml-4">
                    <div className="text-red-600 font-bold text-lg">{milestone.year}</div>
                    <div className="font-semibold text-gray-900">{milestone.title}</div>
                    <div className="text-gray-600">{milestone.desc}</div>
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
