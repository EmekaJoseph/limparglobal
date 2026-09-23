<script setup lang="ts">
defineProps<{
  steps: string[]
}>()
</script>

<template>
  <div class="grid grid-cols-2 gap-x-6 gap-y-8 sm:grid-cols-3 lg:flex lg:gap-0">
    <div
      v-for="(step, i) in steps"
      :key="step"
      class="flex flex-col gap-2 border-t-2 border-limpar-deep pt-4 lg:flex-1 lg:px-6 lg:first:pl-0 lg:last:pr-0"
    >
      <span class="font-heading text-sm font-bold text-limpar-deep">{{ String(i + 1).padStart(2, '0') }}</span>
      <span class="text-sm font-semibold leading-snug text-limpar-ink">{{ step }}</span>
    </div>
  </div>
</template>
