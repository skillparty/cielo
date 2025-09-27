import Layout from '@/components/layout/Layout'
import AboutHero from '@/components/about/AboutHero'
import OurStory from '@/components/about/OurStory'
import TeamSection from '@/components/about/TeamSection'
import ValuesSection from '@/components/about/ValuesSection'

export default function AboutPage() {
  return (
    <Layout>
      <AboutHero />
      <OurStory />
      <ValuesSection />
      <TeamSection />
    </Layout>
  )
}
