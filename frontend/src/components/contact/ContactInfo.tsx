import { EnvelopeIcon, PhoneIcon, MapPinIcon, ClockIcon } from '@heroicons/react/24/outline'
import { Card, CardContent } from '@/components/ui/Card'

const contactDetails = [
  {
    icon: PhoneIcon,
    title: 'Teléfono',
    details: [
      { label: 'Ventas', value: '+591 2 123-4567' },
      { label: 'WhatsApp', value: '+591 7 890-1234' }
    ]
  },
  {
    icon: EnvelopeIcon,
    title: 'Email',
    details: [
      { label: 'General', value: 'info@cielocarnes.com' },
      { label: 'Ventas', value: 'ventas@cielocarnes.com' },
      { label: 'Soporte', value: 'soporte@cielocarnes.com' }
    ]
  },
  {
    icon: MapPinIcon,
    title: 'Dirección',
    details: [
      { label: 'Tienda Principal', value: 'Av. Principal 123' },
      { label: 'Ciudad', value: 'La Paz, Bolivia' },
      { label: 'Zona', value: 'Sopocachi' }
    ]
  },
  {
    icon: ClockIcon,
    title: 'Horarios de Atención',
    details: [
      { label: 'Lunes - Viernes', value: '8:00 AM - 6:00 PM' },
      { label: 'Sábados', value: '8:00 AM - 2:00 PM' },
      { label: 'Domingos', value: 'Cerrado' }
    ]
  }
]

export default function ContactInfo() {
  return (
    <div className="space-y-6">
      <div>
        <h2 className="text-2xl font-bold text-gray-900 mb-4">
          Información de Contacto
        </h2>
        <p className="text-gray-600 mb-6">
          Puedes contactarnos a través de cualquiera de estos medios. 
          Estamos aquí para ayudarte con todas tus consultas.
        </p>
      </div>

      <div className="space-y-4">
        {contactDetails.map((item, index) => (
          <Card key={index}>
            <CardContent className="p-4">
              <div className="flex items-start">
                <div className="flex-shrink-0">
                  <div className="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
                    <item.icon className="h-5 w-5 text-red-600" />
                  </div>
                </div>
                <div className="ml-4 flex-1">
                  <h3 className="font-semibold text-gray-900 mb-2">
                    {item.title}
                  </h3>
                  <div className="space-y-1">
                    {item.details.map((detail, idx) => (
                      <div key={idx} className="flex justify-between items-center">
                        <span className="text-sm text-gray-600">{detail.label}:</span>
                        <span className="text-sm font-medium text-gray-900">{detail.value}</span>
                      </div>
                    ))}
                  </div>
                </div>
              </div>
            </CardContent>
          </Card>
        ))}
      </div>

      {/* Quick Actions */}
      <Card className="bg-red-50 border-red-200">
        <CardContent className="p-6 text-center">
          <h3 className="font-semibold text-gray-900 mb-3">
            ¿Necesitas ayuda inmediata?
          </h3>
          <div className="space-y-3">
            <a
              href="tel:+59121234567"
              className="block w-full bg-red-600 text-white py-2 px-4 rounded-lg hover:bg-red-700 transition-colors"
            >
              Llamar Ahora
            </a>
            <a
              href="https://wa.me/59178901234"
              target="_blank"
              rel="noopener noreferrer"
              className="block w-full bg-green-600 text-white py-2 px-4 rounded-lg hover:bg-green-700 transition-colors"
            >
              WhatsApp
            </a>
          </div>
        </CardContent>
      </Card>
    </div>
  )
}
