const routes = [
  { path: '/', priority: '1.0', changefreq: 'weekly' },
  { path: '/for-employers', priority: '0.9', changefreq: 'monthly' },
  { path: '/for-talent', priority: '0.9', changefreq: 'monthly' },
  { path: '/talent-development', priority: '0.8', changefreq: 'monthly' },
  { path: '/organisational-solutions', priority: '0.8', changefreq: 'monthly' },
  { path: '/about', priority: '0.7', changefreq: 'monthly' },
  { path: '/insights', priority: '0.6', changefreq: 'weekly' },
  { path: '/contact', priority: '0.5', changefreq: 'yearly' },
  { path: '/privacy-policy', priority: '0.2', changefreq: 'yearly' }
  // '/terms' intentionally omitted for now — page exists but isn't linked or ready yet
]

export default defineEventHandler((event) => {
  const origin = useRuntimeConfig(event).public.siteUrl

  const urls = routes
    .map(
      (route) => `  <url>
    <loc>${origin}${route.path}</loc>
    <changefreq>${route.changefreq}</changefreq>
    <priority>${route.priority}</priority>
  </url>`
    )
    .join('\n')

  const xml = `<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
${urls}
</urlset>`

  setHeader(event, 'content-type', 'application/xml')
  return xml
})
