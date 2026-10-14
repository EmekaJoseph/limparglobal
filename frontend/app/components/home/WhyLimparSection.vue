<script setup lang="ts">
import { whyLimpar } from '~/data/whyLimpar'
</script>

<template>
  <section class="bg-white">
    <div class="mx-auto max-w-8xl px-4 py-20 sm:px-6 lg:px-8">
      <div class="flex flex-col gap-3">
        <span class="inline-flex self-start items-center rounded-full bg-limpar-pale px-4 py-1.5 font-heading text-xs font-bold uppercase tracking-widest text-limpar-deep">Why Limpar</span>
        <h2 class="font-heading text-3xl font-bold text-limpar-ink sm:text-4xl">A practical, integrated partner for growth</h2>
      </div>
      <div class="mt-10 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-5">
        <div
          v-for="item in whyLimpar"
          :key="item.title"
          class="flex flex-col gap-4 rounded-2xl border border-limpar-pale-border bg-white p-6 shadow-subtle transition-shadow duration-200 hover:shadow-card"
        >
          <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-limpar-deep text-white shadow-soft">
            <AppIcon :name="item.icon" class="h-5 w-5" />
          </div>
          <div class="flex flex-col gap-2">
            <h3 class="font-heading text-base font-bold text-limpar-ink">{{ item.title }}</h3>
            <p class="text-sm leading-relaxed text-limpar-slate">{{ item.description }}</p>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
