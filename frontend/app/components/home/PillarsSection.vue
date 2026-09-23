<script setup lang="ts">
import { pillars } from '~/data/pillars'
</script>

<template>
  <section class="bg-limpar-pale">
    <div class="mx-auto max-w-8xl px-4 py-20 sm:px-6 lg:px-8">
      <div class="flex flex-col gap-3">
        <span class="font-heading text-sm font-bold uppercase tracking-widest text-limpar-deep">What We Do</span>
        <h2 class="font-heading text-3xl font-bold text-limpar-ink sm:text-4xl">We help organisations and talent grow</h2>
      </div>
      <div class="mt-10 grid grid-cols-1 gap-6 md:grid-cols-3">
        <NuxtLink
          v-for="pillar in pillars"
          :key="pillar.title"
          :to="pillar.to"
          class="group flex flex-col gap-4 rounded-2xl border border-limpar-pale-border bg-white p-8 shadow-subtle transition-all duration-200 hover:-translate-y-1 hover:shadow-lifted"
        >
          <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-limpar-deep text-white shadow-soft">
            <AppIcon :name="pillar.icon" class="h-5 w-5" />
          </div>
          <h3 class="font-heading text-xl font-bold text-limpar-ink">{{ pillar.title }}</h3>
          <p class="text-sm leading-relaxed text-limpar-slate">{{ pillar.description }}</p>
          <span class="mt-auto flex items-center gap-1 text-sm font-bold text-limpar-deep">
            Explore
            <AppIcon name="arrow-right" class="h-4 w-4 transition-transform group-hover:translate-x-1" />
          </span>
        </NuxtLink>
      </div>
    </div>
  </section>
</template>
