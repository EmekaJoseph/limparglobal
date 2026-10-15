<script setup lang="ts">
import type { ProcessStep } from '~/data/processes'

defineProps<{
  steps: ProcessStep[]
}>()
</script>

<template>
  <div class="relative">
    <div class="pointer-events-none absolute left-6 right-6 top-6 hidden h-px bg-limpar-pale-border lg:block" />
    <div class="relative grid grid-cols-2 gap-x-6 gap-y-10 sm:grid-cols-3 lg:flex lg:grid-cols-none lg:gap-0">
      <div
        v-for="(step, i) in steps"
        :key="step.label"
        class="flex flex-col items-start gap-3 lg:flex-1 lg:items-center lg:px-2 lg:text-center"
      >
        <span class="relative z-10 flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-limpar-deep text-white shadow-soft">
          <AppIcon :name="step.icon" class="h-5 w-5" />
        </span>
        <div>
          <span class="block font-heading text-[11px] font-bold uppercase tracking-wider text-limpar-amber">Step {{ String(i + 1).padStart(2, '0') }}</span>
          <span class="mt-1 block text-sm font-semibold leading-snug text-limpar-ink">{{ step.label }}</span>
        </div>
      </div>
    </div>
  </div>
</template>
