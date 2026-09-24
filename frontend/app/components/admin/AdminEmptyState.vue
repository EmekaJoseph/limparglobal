<script setup lang="ts">
defineProps<{
  icon: string
  title: string
  description?: string
}>()
</script>

<template>
  <div class="flex flex-col items-center justify-center px-6 py-16 text-center">
    <span class="flex h-12 w-12 items-center justify-center rounded-full bg-limpar-pale text-limpar-deep">
      <AppIcon :name="icon" class="h-5 w-5" />
    </span>
    <p class="mt-4 font-heading text-base font-bold text-limpar-ink">{{ title }}</p>
    <p v-if="description" class="mt-1 max-w-sm text-sm text-limpar-slate">{{ description }}</p>
  </div>
</template>
