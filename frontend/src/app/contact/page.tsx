import Layout from '@/components/layout/Layout'
import ContactHero from '@/components/contact/ContactHero'
import ContactForm from '@/components/contact/ContactForm'
import ContactInfo from '@/components/contact/ContactInfo'
import LocationMap from '@/components/contact/LocationMap'

export default function ContactPage() {
  return (
    <Layout>
      <ContactHero />
      <div className="w-full mx-auto px-3 sm:px-4 md:px-6 lg:px-8 xl:px-12 2xl:px-16 py-12 sm:py-16">
        <div className="grid grid-cols-1 lg:grid-cols-2 gap-8 sm:gap-12">
          <ContactForm />
          <ContactInfo />
        </div>
      </div>
      <LocationMap />
    </Layout>
  )
}
