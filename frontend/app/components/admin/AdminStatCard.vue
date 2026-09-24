<script setup lang="ts">
defineProps<{
  label: string
  value: number | string
  icon: string
  hint?: string
}>()
</script>

<template>
  <div class="rounded-2xl border border-limpar-pale-border bg-white p-5 shadow-subtle">
    <div class="flex items-center justify-between">
      <span class="flex h-10 w-10 items-center justify-center rounded-full bg-limpar-pale text-limpar-deep">
        <AppIcon :name="icon" class="h-5 w-5" />
      </span>
      <span v-if="hint" class="rounded-full bg-limpar-pale px-2.5 py-1 text-xs font-semibold text-limpar-deep">{{ hint }}</span>
    </div>
    <p class="mt-4 font-heading text-3xl font-bold text-limpar-ink">{{ value }}</p>
    <p class="mt-1 text-sm text-limpar-slate">{{ label }}</p>
  </div>
</template>
