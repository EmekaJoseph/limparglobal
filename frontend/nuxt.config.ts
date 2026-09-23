// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  compatibilityDate: '2025-07-15',
  devtools: { enabled: true },
  modules: ['@nuxtjs/tailwindcss'],
  css: ['~/assets/css/main.css'],
  components: [
    { path: '~/components', pathPrefix: false }
  ],
  nitro: {
    preset: 'static',
    prerender: {
      crawlLinks: true,
      routes: ['/sitemap.xml']
    }
  },
  runtimeConfig: {
    public: {
      siteUrl: 'https://limparglobal.org',
      // Laravel API base URL. Override with NUXT_PUBLIC_API_BASE_URL once the backend is deployed.
      apiBaseUrl: 'http://localhost:8000/api'
    }
  },
  app: {
    head: {
      htmlAttrs: { lang: 'en' },
      meta: [
        { name: 'description', content: 'Limpar Global helps organisations access and develop African talent, while helping African professionals become more work-ready and globally competitive.' },
        { name: 'viewport', content: 'width=device-width, initial-scale=1' },
        { name: 'theme-color', content: '#0A4DA6' },
        { name: 'robots', content: 'index, follow' },
        { property: 'og:site_name', content: 'Limpar Global' },
        { property: 'og:locale', content: 'en_US' }
      ],
      link: [
        { rel: 'icon', type: 'image/png', href: '/logo.png' },
        { rel: 'apple-touch-icon', href: '/logo.png' }
      ]
    }
  }
})
