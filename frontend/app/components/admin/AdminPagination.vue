<script setup lang="ts">
const props = defineProps<{
  currentPage: number
  lastPage: number
  total: number
}>()

const emit = defineEmits<{
  change: [page: number]
}>()
</script>

<template>
  <div v-if="props.lastPage > 1" class="flex flex-wrap items-center justify-between gap-3 border-t border-limpar-pale-border px-5 py-4">
    <p class="text-sm text-limpar-slate">Page {{ props.currentPage }} of {{ props.lastPage }} &middot; {{ props.total }} total</p>
    <div class="flex gap-2">
      <button
        type="button"
        class="rounded-lg border border-limpar-pale-border px-3 py-1.5 text-sm font-medium text-limpar-ink transition-colors hover:border-limpar-deep disabled:cursor-not-allowed disabled:opacity-40 disabled:hover:border-limpar-pale-border"
        :disabled="props.currentPage <= 1"
        @click="emit('change', props.currentPage - 1)"
      >
        Previous
      </button>
      <button
        type="button"
        class="rounded-lg border border-limpar-pale-border px-3 py-1.5 text-sm font-medium text-limpar-ink transition-colors hover:border-limpar-deep disabled:cursor-not-allowed disabled:opacity-40 disabled:hover:border-limpar-pale-border"
        :disabled="props.currentPage >= props.lastPage"
        @click="emit('change', props.currentPage + 1)"
      >
        Next
      </button>
    </div>
  </div>
</template>
