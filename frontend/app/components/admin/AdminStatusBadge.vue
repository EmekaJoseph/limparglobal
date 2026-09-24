<script setup lang="ts">
const props = defineProps<{
  status: string
}>()

const styles: Record<string, string> = {
  new: 'bg-limpar-sky-light/25 text-limpar-deep-dark',
  contacted: 'bg-amber-100 text-amber-700',
  shortlisted: 'bg-emerald-100 text-emerald-700',
  in_progress: 'bg-amber-100 text-amber-700',
  rejected: 'bg-rose-100 text-rose-700',
  closed: 'bg-limpar-slate/15 text-limpar-slate'
}

const labels: Record<string, string> = {
  new: 'New',
  contacted: 'Contacted',
  shortlisted: 'Shortlisted',
  in_progress: 'In progress',
  rejected: 'Rejected',
  closed: 'Closed'
}
</script>

<template>
  <span
    class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold capitalize"
    :class="styles[props.status] ?? 'bg-limpar-pale text-limpar-slate'"
  >
    {{ labels[props.status] ?? props.status }}
  </span>
</template>
