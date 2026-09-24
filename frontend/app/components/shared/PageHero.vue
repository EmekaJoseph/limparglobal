<script setup lang="ts">
defineProps<{
  eyebrow: string
  title: string
  description: string
}>()
</script>

<template>
  <section class="border-b border-limpar-pale-border bg-limpar-pale">
    <div class="mx-auto max-w-8xl px-4 py-20 sm:px-6 lg:px-8">
      <div class="flex flex-col items-start gap-8 lg:flex-row lg:items-center lg:justify-between lg:gap-12">
        <div class="flex max-w-2xl flex-col gap-5">
          <span class="inline-flex self-start items-center rounded-full bg-white px-4 py-1.5 font-heading text-xs font-bold uppercase tracking-widest text-limpar-deep">{{ eyebrow }}</span>
          <h1 class="font-heading text-4xl font-extrabold leading-tight text-limpar-ink sm:text-5xl">{{ title }}</h1>
          <p class="text-lg leading-relaxed text-limpar-slate">{{ description }}</p>
          <div v-if="$slots.default" class="mt-2 flex flex-wrap gap-4">
            <slot />
          </div>
        </div>
        <slot name="visual" />
      </div>
    </div>
  </section>
</template>
