<script setup lang="ts">
import type { ServiceItem } from '~/data/orgServices'

defineProps<{
  items: ServiceItem[]
}>()
</script>

<template>
  <ul class="divide-y divide-limpar-pale-border border-y border-limpar-pale-border">
    <li
      v-for="(item, i) in items"
      :key="item.label"
      class="group flex items-center gap-5 py-5 sm:gap-6"
    >
      <span class="w-6 shrink-0 font-heading text-sm font-bold text-limpar-amber">{{ String(i + 1).padStart(2, '0') }}</span>
      <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full border border-limpar-pale-border text-limpar-deep transition-colors duration-200 group-hover:border-limpar-deep group-hover:bg-limpar-deep group-hover:text-white">
        <AppIcon :name="item.icon" class="h-4 w-4" />
      </span>
      <span class="font-heading text-lg font-semibold text-limpar-ink sm:text-xl">{{ item.label }}</span>
    </li>
  </ul>
</template>
