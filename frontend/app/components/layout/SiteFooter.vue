<script setup lang="ts">
import { footerNav } from '~/data/navigation'
const company = useCompanySettings()

const year = new Date().getFullYear()
</script>

<template>
  <footer class="bg-limpar-ink text-white">
    <div class="mx-auto max-w-8xl px-4 py-16 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 gap-12 lg:grid-cols-[1.4fr_1fr_1fr_1.1fr]">
        <div class="flex flex-col gap-4">
          <div class="flex items-center gap-3">
            <img src="/logo.png" alt="Limpar Global" class="h-10 w-10 rounded-lg object-cover" width="512" height="512">
            <span class="font-heading text-lg font-bold text-white">Limpar Global</span>
          </div>
          <p class="max-w-sm text-sm leading-relaxed text-white/65">{{ company.positioning }}</p>
          <span class="text-sm font-semibold text-limpar-sky-light">{{ company.tagline }}</span>
        </div>

        <div class="flex flex-col gap-3">
          <span class="font-heading text-sm font-bold uppercase tracking-wide text-white/50">Solutions</span>
          <NuxtLink
            v-for="link in footerNav.solutions"
            :key="link.to"
            :to="link.to"
            class="text-sm text-white/75 transition-colors hover:text-limpar-sky-light"
          >
            {{ link.label }}
          </NuxtLink>
        </div>

        <div class="flex flex-col gap-3">
          <span class="font-heading text-sm font-bold uppercase tracking-wide text-white/50">Company</span>
          <NuxtLink
            v-for="link in footerNav.company"
            :key="link.to"
            :to="link.to"
            class="text-sm text-white/75 transition-colors hover:text-limpar-sky-light"
          >
            {{ link.label }}
          </NuxtLink>
        </div>

        <div class="flex flex-col gap-3">
          <span class="font-heading text-sm font-bold uppercase tracking-wide text-white/50">Get in Touch</span>
          <a :href="`mailto:${company.email}`" class="flex items-center gap-2 text-sm text-white/75 transition-colors hover:text-limpar-sky-light">
            <AppIcon name="mail" class="h-4 w-4 shrink-0" />
            {{ company.email }}
          </a>
          <a :href="company.linkedin" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2 text-sm text-white/75 transition-colors hover:text-limpar-sky-light">
            <AppIcon name="linkedin" class="h-4 w-4 shrink-0" />
            LinkedIn
          </a>
          <span class="text-sm text-white/50">{{ company.location }}</span>
        </div>
      </div>

      <div class="mt-14 flex flex-col gap-3 border-t border-white/10 pt-6 text-xs text-white/45 sm:flex-row sm:items-center sm:justify-between">
        <span>© {{ year }} Limpar Global. All rights reserved.</span>
        <div class="flex items-center gap-4">
          <NuxtLink to="/privacy-policy" class="transition-colors hover:text-limpar-sky-light">Privacy Policy</NuxtLink>
          <!-- <NuxtLink to="/terms" class="transition-colors hover:text-limpar-sky-light">Terms of Use</NuxtLink> -->
        </div>
      </div>
    </div>
  </footer>
</template>
