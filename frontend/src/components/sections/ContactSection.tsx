import Link from 'next/link'
import { EnvelopeIcon, PhoneIcon, MapPinIcon, ClockIcon } from '@heroicons/react/24/outline'
import Button from '@/components/ui/Button'
import { Card, CardContent } from '@/components/ui/Card'

const contactInfo = [
  {
    icon: PhoneIcon,
    title: 'Teléfono',
    details: ['+591 2 123-4567', '+591 7 890-1234'],
    action: 'Llamar ahora'
  },
  {
    icon: EnvelopeIcon,
    title: 'Email',
    details: ['info@cielocarnes.com', 'ventas@cielocarnes.com'],
    action: 'Enviar email'
  },
  {
    icon: MapPinIcon,
    title: 'Ubicación',
    details: ['Av. Principal 123', 'La Paz, Bolivia'],
    action: 'Ver en mapa'
  },
  {
    icon: ClockIcon,
    title: 'Horarios',
    details: ['Lun - Vie: 8:00 - 18:00', 'Sáb: 8:00 - 14:00'],
    action: 'Ver horarios'
  }
]

export default function ContactSection() {
  return (
    <section className="py-16 bg-white">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {/* Header */}
        <div className="text-center mb-12">
          <h2 className="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
            ¿Tienes Preguntas?
          </h2>
          <p className="text-xl text-gray-600 max-w-2xl mx-auto">
            Estamos aquí para ayudarte. Contáctanos por cualquier consulta 
            sobre nuestros productos o servicios.
          </p>
        </div>

        {/* Contact Cards */}
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
          {contactInfo.map((item, index) => (
            <Card key={index} className="text-center hover:shadow-lg transition-shadow duration-300">
              <CardContent className="p-6">
                <div className="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                  <item.icon className="h-6 w-6 text-red-600" />
                </div>
                <h3 className="font-semibold text-gray-900 mb-3">
                  {item.title}
                </h3>
                <div className="space-y-1 mb-4">
                  {item.details.map((detail, idx) => (
                    <p key={idx} className="text-sm text-gray-600">
                      {detail}
                    </p>
                  ))}
                </div>
                <Button variant="ghost" size="sm" className="text-red-600">
                  {item.action}
                </Button>
              </CardContent>
            </Card>
          ))}
        </div>

        {/* CTA Section */}
        <div className="bg-gradient-to-r from-red-600 to-red-800 rounded-2xl p-8 md:p-12 text-white text-center">
          <h3 className="text-2xl md:text-3xl font-bold mb-4">
            ¿Listo para hacer tu pedido?
          </h3>
          <p className="text-red-100 text-lg mb-6 max-w-2xl mx-auto">
            Explora nuestra amplia selección de carnes y fiambres premium. 
            Realizamos entregas a domicilio en toda La Paz.
          </p>
          <div className="flex flex-col sm:flex-row gap-4 justify-center">
            <Button 
              size="lg" 
              className="bg-white text-red-600 hover:bg-gray-100"
              asChild
            >
              <Link href="/shop">
                Ver Catálogo Completo
              </Link>
            </Button>
            <Button 
              variant="outline" 
              size="lg"
              className="border-2 border-white text-white hover:bg-white hover:text-red-600"
              asChild
            >
              <Link href="/contact">
                Contactar Ahora
              </Link>
            </Button>
          </div>
        </div>

        {/* Quick Contact */}
        <div className="mt-12 text-center">
          <p className="text-gray-600 mb-4">
            ¿Necesitas ayuda inmediata? Llámanos directamente:
          </p>
          <a 
            href="tel:+59121234567" 
            className="inline-flex items-center text-2xl font-bold text-red-600 hover:text-red-700 transition-colors"
          >
            <PhoneIcon className="h-6 w-6 mr-2" />
            +591 2 123-4567
          </a>
        </div>
      </div>
    </section>
  )
}
