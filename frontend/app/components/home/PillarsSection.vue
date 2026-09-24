<script setup lang="ts">
import { pillars } from '~/data/pillars'

const cardStyles = [
  {
    card: 'bg-limpar-deep hover:shadow-lifted',
    icon: 'bg-white/15 text-white',
    title: 'text-white',
    body: 'text-white/75',
    link: 'text-white'
  },
  {
    card: 'bg-white shadow-card hover:shadow-lifted',
    icon: 'bg-limpar-deep text-white shadow-soft',
    title: 'text-limpar-ink',
    body: 'text-limpar-slate',
    link: 'text-limpar-deep'
  },
  {
    card: 'bg-limpar-pale hover:shadow-lifted',
    icon: 'bg-limpar-deep text-white shadow-soft',
    title: 'text-limpar-ink',
    body: 'text-limpar-slate',
    link: 'text-limpar-deep'
  }
]
</script>

<template>
  <section class="bg-limpar-pale">
    <div class="mx-auto max-w-8xl px-4 py-20 sm:px-6 lg:px-8">
      <div class="flex flex-col gap-3">
        <span class="inline-flex self-start items-center rounded-full bg-white px-4 py-1.5 font-heading text-xs font-bold uppercase tracking-widest text-limpar-deep">What We Do</span>
        <h2 class="font-heading text-3xl font-bold text-limpar-ink sm:text-4xl">We help organisations and talent grow</h2>
      </div>
      <div class="mt-10 grid grid-cols-1 gap-6 md:grid-cols-3">
        <NuxtLink
          v-for="(pillar, i) in pillars"
          :key="pillar.title"
          :to="pillar.to"
          class="group flex flex-col gap-4 rounded-2xl p-8 transition-all duration-200 hover:-translate-y-1"
          :class="cardStyles[i % cardStyles.length].card"
        >
          <div class="flex h-11 w-11 items-center justify-center rounded-xl" :class="cardStyles[i % cardStyles.length].icon">
            <AppIcon :name="pillar.icon" class="h-5 w-5" />
          </div>
          <h3 class="font-heading text-xl font-bold" :class="cardStyles[i % cardStyles.length].title">{{ pillar.title }}</h3>
          <p class="text-sm leading-relaxed" :class="cardStyles[i % cardStyles.length].body">{{ pillar.description }}</p>
          <span class="mt-auto flex items-center gap-1 text-sm font-bold" :class="cardStyles[i % cardStyles.length].link">
            Explore
            <AppIcon name="arrow-right" class="h-4 w-4 transition-transform group-hover:translate-x-1" />
          </span>
        </NuxtLink>
      </div>
    </div>
  </section>
</template>
