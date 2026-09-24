<script setup lang="ts">
defineProps<{
  title: string
  description?: string
  primaryLabel: string
  primaryTo: string
  secondaryLabel?: string
  secondaryTo?: string
}>()
</script>

<template>
  <section class="bg-limpar-deep">
    <div class="mx-auto max-w-8xl px-4 py-16 sm:px-6 lg:px-8">
      <div class="flex flex-col items-start gap-6 lg:flex-row lg:items-center lg:justify-between">
        <div class="flex flex-col gap-2">
          <h2 class="font-heading text-2xl font-bold text-white sm:text-3xl">{{ title }}</h2>
          <p v-if="description" class="max-w-xl text-white/75">{{ description }}</p>
        </div>
        <div class="flex flex-wrap gap-4">
          <NuxtLink
            :to="primaryTo"
            class="inline-flex items-center gap-3 rounded-full bg-white py-2 pl-6 pr-2 text-sm font-bold text-limpar-deep shadow-[0_16px_32px_-14px_rgba(0,0,0,0.4)] transition-all hover:-translate-y-0.5 hover:bg-limpar-pale hover:shadow-[0_20px_40px_-14px_rgba(0,0,0,0.45)]"
          >
            {{ primaryLabel }}
            <span class="flex h-8 w-8 items-center justify-center rounded-full bg-limpar-pale">
              <AppIcon name="arrow-right" class="h-4 w-4 text-limpar-deep" />
            </span>
          </NuxtLink>
          <NuxtLink
            v-if="secondaryLabel && secondaryTo"
            :to="secondaryTo"
            class="inline-flex items-center gap-3 rounded-full border border-white/40 py-2 pl-6 pr-2 text-sm font-bold text-white transition-all hover:-translate-y-0.5 hover:bg-white/10"
          >
            {{ secondaryLabel }}
            <span class="flex h-8 w-8 items-center justify-center rounded-full bg-white/15">
              <AppIcon name="arrow-right" class="h-4 w-4 text-white" />
            </span>
          </NuxtLink>
        </div>
      </div>
    </div>
  </section>
</template>
