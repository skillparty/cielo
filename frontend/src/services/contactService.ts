import { api } from '@/lib/api'
import { ContactForm } from '@/types'

export const contactService = {
  // Send contact message
  async sendMessage(data: ContactForm): Promise<void> {
    await api.post('/contact', data)
  }
}
