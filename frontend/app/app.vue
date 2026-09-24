<script setup lang="ts">
const company = useCompanySettings()

const siteUrl = useRuntimeConfig().public.siteUrl

useHead({
  titleTemplate: (chunk) =>
    chunk && chunk !== 'Limpar Global'
      ? `${chunk} | Limpar Global`
      : 'Limpar Global | African Workforce & Talent Partner',
  script: [
    {
      type: 'application/ld+json',
      innerHTML: JSON.stringify({
        '@context': 'https://schema.org',
        '@type': 'Organization',
        name: 'Limpar Global',
        url: siteUrl,
        logo: new URL('/logo.png', siteUrl).toString(),
        description: company.positioning,
        slogan: company.tagline
      })
    },
    {
      type: 'application/ld+json',
      innerHTML: JSON.stringify({
        '@context': 'https://schema.org',
        '@type': 'WebSite',
        name: 'Limpar Global',
        url: siteUrl
      })
    }
  ]
})
</script>

<template>
  <div>
    <NuxtRouteAnnouncer />
    <NuxtLayout>
      <NuxtPage />
    </NuxtLayout>
  </div>
</template>
