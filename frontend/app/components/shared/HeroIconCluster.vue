<script setup lang="ts">
defineProps<{
  icons: [string, string, string, string]
}>()
</script>

<template>
  <div class="relative hidden h-64 w-64 shrink-0 lg:block">
    <div class="absolute left-0 top-4 flex h-24 w-24 items-center justify-center rounded-3xl bg-limpar-deep text-white shadow-panel">
      <AppIcon :name="icons[0]" class="h-9 w-9" />
    </div>
    <div class="absolute right-0 top-0 flex h-20 w-20 items-center justify-center rounded-2xl bg-white text-limpar-deep shadow-card ring-1 ring-limpar-pale-border">
      <AppIcon :name="icons[1]" class="h-8 w-8" />
    </div>
    <div class="absolute bottom-4 left-12 flex h-20 w-20 items-center justify-center rounded-2xl bg-limpar-sky text-white shadow-card">
      <AppIcon :name="icons[2]" class="h-8 w-8" />
    </div>
    <div class="absolute bottom-0 right-6 flex h-16 w-16 items-center justify-center rounded-xl bg-white text-limpar-deep shadow-subtle ring-1 ring-limpar-pale-border">
      <AppIcon :name="icons[3]" class="h-6 w-6" />
    </div>
  </div>
</template>
