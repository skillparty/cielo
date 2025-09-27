/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./src/pages/**/*.{js,ts,jsx,tsx,mdx}",
    "./src/components/**/*.{js,ts,jsx,tsx,mdx}",
    "./src/app/**/*.{js,ts,jsx,tsx,mdx}",
  ],
  theme: {
    extend: {
      fontFamily: {
        'display': ['Playfair Display', 'serif'],
        'sans': ['Inter', 'system-ui', 'sans-serif'],
        'mono': ['JetBrains Mono', 'monospace'],
      },
      colors: {
        // Primary Colors - Red/Meat Theme
        primary: {
          50: '#FEF2F3',
          100: '#FCE4E6',
          200: '#F9C9CE',
          300: '#F4A1A9',
          400: '#EC6F7F',
          500: '#E14455',
          600: '#CC2A3C',
          700: '#8B2635', // Main brand color - Rojo Carne
          800: '#742230',
          900: '#5D1921', // Dark accent
          950: '#3A0E14',
        },
        // Secondary Colors - Gold/Premium
        secondary: {
          50: '#FDF9F3',
          100: '#FBF0E0',
          200: '#F6DFC0',
          300: '#F0C896',
          400: '#E8B87F',
          500: '#D4A574', // Main gold - Dorado
          600: '#B8864F',
          700: '#9A6B3F',
          800: '#7D5636',
          900: '#6F4E37', // Brown support
          950: '#3D2A1C',
        },
        // Neutral Colors
        neutral: {
          50: '#FFFFFF',
          100: '#FFF8F3', // Cream background
          200: '#ECF0F1', // Light gray
          300: '#D5DBDD',
          400: '#BDC3C7',
          500: '#95A5A6',
          600: '#7F8C8D', // Medium gray
          700: '#5D6D7E',
          800: '#34495E',
          900: '#2C3E50', // Dark gray for text
          950: '#1C2833',
        },
        // State Colors
        success: '#27AE60',
        warning: '#F39C12',
        error: '#E74C3C',
        info: '#3498DB',
        // Background variations
        cream: '#FFF8F3',
        'light-gray': '#ECF0F1',
        'dark-gray': '#2C3E50',
      },
      backgroundImage: {
        'gradient-primary': 'linear-gradient(135deg, #8B2635 0%, #CC2A3C 50%, #D4A574 100%)',
        'gradient-hero': 'linear-gradient(180deg, rgba(139,38,53,0.95) 0%, rgba(139,38,53,0.8) 50%, rgba(139,38,53,0.6) 100%)',
        'gradient-card': 'linear-gradient(145deg, #FFFFFF 0%, #FFF8F3 100%)',
        'gradient-premium': 'linear-gradient(135deg, #D4A574 0%, #E8B87F 50%, #F0C896 100%)',
      },
      boxShadow: {
        'soft': '0 2px 8px rgba(0,0,0,0.08)',
        'medium': '0 4px 16px rgba(0,0,0,0.12)',
        'strong': '0 8px 32px rgba(0,0,0,0.16)',
        'premium': '0 12px 48px rgba(212,165,116,0.25)',
      },
      animation: {
        'fade-in': 'fadeIn 0.3s ease-in-out',
        'slide-up': 'slideUp 0.4s ease-out',
        'slide-down': 'slideDown 0.4s ease-out',
        'scale-up': 'scaleUp 0.3s ease-out',
        'pulse-soft': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
      },
      keyframes: {
        fadeIn: {
          '0%': { opacity: '0' },
          '100%': { opacity: '1' },
        },
        slideUp: {
          '0%': { transform: 'translateY(20px)', opacity: '0' },
          '100%': { transform: 'translateY(0)', opacity: '1' },
        },
        slideDown: {
          '0%': { transform: 'translateY(-20px)', opacity: '0' },
          '100%': { transform: 'translateY(0)', opacity: '1' },
        },
        scaleUp: {
          '0%': { transform: 'scale(0.95)', opacity: '0' },
          '100%': { transform: 'scale(1)', opacity: '1' },
        },
      },
    },
  },
  plugins: [],
}
