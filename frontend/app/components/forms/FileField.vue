<script setup lang="ts">
defineProps<{
  modelValue: File | null
  accept?: string
  id?: string
}>()

const emit = defineEmits<{
  'update:modelValue': [value: File | null]
}>()

function handleChange(event: Event) {
  const file = (event.target as HTMLInputElement).files?.[0] ?? null
  emit('update:modelValue', file)
}
</script>

<template>
  <div class="flex items-center gap-3 rounded-lg border border-dashed border-limpar-pale-border bg-white px-4 py-3 shadow-subtle">
    <label :for="id" class="inline-flex shrink-0 cursor-pointer items-center gap-2 rounded-lg bg-limpar-pale px-4 py-2 text-sm font-semibold text-limpar-deep transition-colors hover:bg-limpar-pale-border">
      <AppIcon name="upload" class="h-4 w-4" />
      Choose file
    </label>
    <input
      :id="id"
      type="file"
      :accept="accept"
      class="hidden"
      @change="handleChange"
    >
    <span class="truncate text-sm text-limpar-slate">
      {{ modelValue ? modelValue.name : 'No file selected' }}
    </span>
  </div>
</template>
