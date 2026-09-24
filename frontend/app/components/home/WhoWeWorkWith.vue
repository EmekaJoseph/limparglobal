<script setup lang="ts">
import { whoWeWorkWith } from '~/data/whyLimpar'
</script>

<template>
  <section class="bg-limpar-pale">
    <div class="mx-auto max-w-8xl px-4 py-20 sm:px-6 lg:px-8">
      <div class="flex flex-col gap-3">
        <span class="inline-flex self-start items-center rounded-full bg-white px-4 py-1.5 font-heading text-xs font-bold uppercase tracking-widest text-limpar-deep">Who We Work With</span>
        <h2 class="font-heading text-3xl font-bold text-limpar-ink sm:text-4xl">Built for organisations and professionals at every stage of growth</h2>
      </div>
      <div class="mt-10 flex flex-wrap gap-3">
        <span
          v-for="item in whoWeWorkWith"
          :key="item"
          class="rounded-full border border-limpar-pale-border bg-white px-5 py-2.5 text-sm font-semibold text-limpar-ink shadow-subtle"
        >
          {{ item }}
        </span>
      </div>
    </div>
  </section>
</template>
