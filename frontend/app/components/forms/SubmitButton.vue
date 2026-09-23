<script setup lang="ts">
defineProps<{
  status: 'idle' | 'submitting' | 'success' | 'error'
  label: string
}>()
</script>

<template>
  <button
    type="submit"
    :disabled="status === 'submitting'"
    class="inline-flex items-center justify-center gap-2 rounded-lg bg-limpar-deep px-8 py-3.5 text-sm font-bold text-white shadow-soft transition-all hover:-translate-y-0.5 hover:bg-limpar-deep-dark hover:shadow-card disabled:cursor-not-allowed disabled:opacity-70 disabled:hover:translate-y-0"
  >
    <AppIcon v-if="status === 'submitting'" name="spinner" class="h-4 w-4 animate-spin" />
    {{ status === 'submitting' ? 'Submitting…' : label }}
  </button>
</template>
