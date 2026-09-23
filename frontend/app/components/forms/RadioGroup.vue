<script setup lang="ts">
const props = defineProps<{
  modelValue: string
  options: string[]
  name: string
  required?: boolean
}>()

const emit = defineEmits<{
  'update:modelValue': [value: string]
}>()
</script>

<template>
  <div class="grid grid-cols-1 gap-2.5 sm:grid-cols-2">
    <label
      v-for="option in options"
      :key="option"
      class="flex cursor-pointer items-center gap-2.5 rounded-lg border border-limpar-pale-border bg-white px-4 py-2.5 text-sm text-limpar-ink shadow-subtle transition-colors has-[:checked]:border-limpar-deep has-[:checked]:bg-limpar-pale has-[:checked]:font-semibold"
    >
      <input
        type="radio"
        :name="name"
        :value="option"
        :checked="modelValue === option"
        :required="required"
        class="h-4 w-4 shrink-0 accent-limpar-deep"
        @change="emit('update:modelValue', option)"
      >
      {{ option }}
    </label>
  </div>
</template>
