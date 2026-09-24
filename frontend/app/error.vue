<script setup lang="ts">
import type { NuxtError } from '#app'
const company = useCompanySettings()

const props = defineProps<{
  error: NuxtError
}>()

const isNotFound = computed(() => props.error?.statusCode === 404)

useSeoMeta({
  title: isNotFound.value ? 'Page Not Found | Limpar Global' : 'Something Went Wrong | Limpar Global',
  robots: 'noindex, nofollow'
})

function handleGoHome() {
  clearError({ redirect: '/' })
}
</script>

<template>
  <NuxtLayout>
    <section class="bg-white">
      <div class="mx-auto flex max-w-3xl flex-col items-center gap-6 px-4 py-28 text-center sm:px-6 lg:px-8">
        <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-limpar-deep text-white">
          <AppIcon name="compass" class="h-7 w-7" />
        </div>

        <span class="inline-flex self-start items-center rounded-full bg-limpar-pale px-4 py-1.5 font-heading text-xs font-bold uppercase tracking-widest text-limpar-deep">
          {{ isNotFound ? 'Error 404' : 'Something Went Wrong' }}
        </span>

        <h1 class="font-heading text-4xl font-extrabold leading-tight text-limpar-ink sm:text-5xl">
          {{ isNotFound ? 'This page took a different path' : 'We hit a snag' }}
        </h1>

        <p class="max-w-xl text-lg leading-relaxed text-limpar-slate">
          {{ isNotFound
            ? "The page you're looking for doesn't exist or may have moved. Let's get you back on track."
            : 'Something went wrong on our end. Please try again, or reach out if the problem continues.' }}
        </p>

        <div class="flex flex-wrap justify-center gap-4 pt-2">
          <button
            type="button"
            class="inline-flex items-center gap-2 rounded-lg bg-limpar-deep px-6 py-3.5 text-sm font-bold text-white shadow-soft transition-all hover:-translate-y-0.5 hover:bg-limpar-deep-dark hover:shadow-card"
            @click="handleGoHome"
          >
            Back to Home
          </button>
          <NuxtLink
            :to="`mailto:${company.email}`"
            class="inline-flex items-center gap-2 rounded-lg border border-limpar-pale-border px-6 py-3.5 text-sm font-bold text-limpar-deep shadow-subtle transition-all hover:-translate-y-0.5 hover:shadow-card"
          >
            Contact Us
          </NuxtLink>
        </div>

        <div v-if="isNotFound" class="mt-10 flex flex-wrap justify-center gap-3">
          <NuxtLink to="/for-employers" class="rounded-full border border-limpar-pale-border px-4 py-2 text-sm font-semibold text-limpar-ink transition-colors hover:bg-limpar-pale">
            For Employers
          </NuxtLink>
          <NuxtLink to="/for-talent" class="rounded-full border border-limpar-pale-border px-4 py-2 text-sm font-semibold text-limpar-ink transition-colors hover:bg-limpar-pale">
            For Talent
          </NuxtLink>
          <NuxtLink to="/talent-development" class="rounded-full border border-limpar-pale-border px-4 py-2 text-sm font-semibold text-limpar-ink transition-colors hover:bg-limpar-pale">
            Talent Development
          </NuxtLink>
          <NuxtLink to="/organisational-solutions" class="rounded-full border border-limpar-pale-border px-4 py-2 text-sm font-semibold text-limpar-ink transition-colors hover:bg-limpar-pale">
            Organisational Solutions
          </NuxtLink>
        </div>
      </div>
    </section>
  </NuxtLayout>
</template>
