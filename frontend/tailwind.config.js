/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./src/pages/**/*.{js,ts,jsx,tsx,mdx}",
    "./src/components/**/*.{js,ts,jsx,tsx,mdx}",
    "./src/app/**/*.{js,ts,jsx,tsx,mdx}",
  ],
  theme: {
    extend: {
      colors: {
        // Cielo Carnes Brand Colors
        primary: {
          50: '#fdf2f4',
          100: '#fce7ea',
          200: '#f9d0d9',
          300: '#f4a8ba',
          400: '#ed7a96',
          500: '#e14d75',
          600: '#cc2c5a',
          700: '#a71d31', // Main madder color
          800: '#8b1a2e',
          900: '#76182b',
        },
        secondary: {
          50: '#fffbeb',
          100: '#fef3c7',
          200: '#fde68a',
          300: '#fcd34d',
          400: '#fbbf24',
          500: '#faa916', // Main orange color
          600: '#d97706',
          700: '#b45309',
          800: '#92400e',
          900: '#78350f',
        },
        dark: {
          50: '#f6f7f6',
          100: '#e3e6e4',
          200: '#c7cdc9',
          300: '#a3aca7',
          400: '#7d8883',
          500: '#626b66',
          600: '#4d5551',
          700: '#404643',
          800: '#363a37',
          900: '#0a0f0d', // Main night color
        },
        neutral: {
          50: '#f9fafa',
          100: '#f4f5f5',
          200: '#e9ebea',
          300: '#d3d6d5',
          400: '#c4cbca', // Main silver color
          500: '#9ca3a2',
          600: '#7c8382',
          700: '#656b6a',
          800: '#555a59',
          900: '#4a4e4d',
        },
      },
      backgroundImage: {
        'gradient-primary': 'linear-gradient(135deg, #a71d31, #faa916)',
        'gradient-hero': 'linear-gradient(135deg, #a71d31 0%, #cc2c5a 50%, #faa916 100%)',
        'gradient-card': 'linear-gradient(145deg, #ffffff 0%, #f9fafa 100%)',
      },
    },
  },
  plugins: [],
}
