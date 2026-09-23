interface PageSeoOptions {
  title: string
  description: string
  image?: string
  noindex?: boolean
}

export function usePageSeo(options: PageSeoOptions) {
  const { title, description, image = '/logo.png', noindex = false } = options
  const siteUrl = useRuntimeConfig().public.siteUrl
  const path = useRequestURL().pathname
  const canonical = new URL(path, siteUrl).toString()
  const imageUrl = new URL(image, siteUrl).toString()

  useSeoMeta({
    title,
    description,
    ogTitle: title,
    ogDescription: description,
    ogImage: imageUrl,
    ogUrl: canonical,
    ogType: 'website',
    ogSiteName: 'Limpar Global',
    twitterCard: 'summary_large_image',
    twitterTitle: title,
    twitterDescription: description,
    twitterImage: imageUrl,
    robots: noindex ? 'noindex, nofollow' : 'index, follow'
  })

  useHead({
    link: [
      { rel: 'canonical', href: canonical }
    ]
  })
}
