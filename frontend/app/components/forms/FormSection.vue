<script setup lang="ts">
defineProps<{
  index: string
  title: string
  description?: string
}>()
</script>

<template>
  <div class="flex flex-col gap-8 border-t-2 border-limpar-deep pt-8 scroll-mt-44 lg:scroll-mt-52">
    <div class="flex flex-col gap-1.5">
      <span class="font-heading text-sm font-bold text-limpar-deep">{{ index }}</span>
      <h3 class="font-heading text-xl font-bold text-limpar-ink sm:text-2xl">{{ title }}</h3>
      <p v-if="description" class="max-w-2xl text-sm leading-relaxed text-limpar-slate">{{ description }}</p>
    </div>
    <div class="flex flex-col gap-6">
      <slot />
    </div>
  </div>
</template>
