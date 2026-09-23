<script setup lang="ts">
defineProps<{
  items: string[]
}>()
</script>

<template>
  <ul class="grid grid-cols-1 gap-4 sm:grid-cols-2">
    <li
      v-for="item in items"
      :key="item"
      class="flex items-start gap-3 rounded-xl border border-limpar-pale-border bg-white p-4 shadow-subtle transition-shadow duration-200 hover:shadow-card"
    >
      <span class="mt-0.5 flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-limpar-pale text-limpar-deep">
        <AppIcon name="check" class="h-3.5 w-3.5" />
      </span>
      <span class="text-sm font-medium text-limpar-ink">{{ item }}</span>
    </li>
  </ul>
</template>
