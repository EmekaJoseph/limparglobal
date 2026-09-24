<script setup lang="ts">
defineProps<{
  label: string
  span?: boolean
}>()
</script>

<template>
  <div :class="span ? 'sm:col-span-2' : ''">
    <p class="text-xs font-semibold uppercase tracking-wide text-limpar-slate/70">{{ label }}</p>
    <div class="mt-1 text-sm leading-relaxed text-limpar-ink">
      <slot />
    </div>
  </div>
</template>
