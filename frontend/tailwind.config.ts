import type { Config } from 'tailwindcss'

export default <Partial<Config>>{
  content: [
    './app/**/*.{vue,js,ts}',
    './app.vue'
  ],
  theme: {
    extend: {
      colors: {
        limpar: {
          ink: '#0B1524',
          slate: '#55667A',
          deep: '#0A4DA6',
          'deep-dark': '#073B82',
          sky: '#29ABE2',
          'sky-light': '#5FD0F5',
          pale: '#EAF4FB',
          'pale-border': '#D6E8F7',
          white: '#FFFFFF'
        }
      },
      fontFamily: {
        heading: ['"Plus Jakarta Sans"', 'system-ui', 'sans-serif'],
        sans: ['"Source Sans 3"', 'system-ui', 'sans-serif']
      },
      boxShadow: {
        subtle: '0 2px 10px -6px rgba(11, 21, 36, 0.10), 0 1px 2px -1px rgba(11, 21, 36, 0.06)',
        card: '0 10px 30px -14px rgba(10, 77, 166, 0.18)',
        lifted: '0 20px 40px -18px rgba(10, 77, 166, 0.28)',
        soft: '0 4px 20px -6px rgba(41, 171, 226, 0.2)',
        panel: '0 30px 60px -28px rgba(10, 77, 166, 0.32), 0 10px 24px -16px rgba(10, 77, 166, 0.18)',
        header: '0 1px 0 rgba(11, 21, 36, 0.04), 0 8px 24px -18px rgba(11, 21, 36, 0.12)'
      },
      maxWidth: {
        '8xl': '90rem'
      }
    }
  },
  plugins: []
}
