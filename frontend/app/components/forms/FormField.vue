<script setup lang="ts">
withDefaults(defineProps<{
  label: string
  required?: boolean
  help?: string
  htmlFor?: string
  error?: string
}>(), {
  required: false,
  help: '',
  htmlFor: '',
  error: ''
})
</script>

<template>
  <div class="flex flex-col gap-2">
    <label :for="htmlFor || undefined" class="text-sm font-semibold text-limpar-ink">
      {{ label }}
      <span v-if="required" class="text-limpar-sky" aria-hidden="true">*</span>
    </label>
    <slot />
    <p v-if="error" class="text-xs font-semibold text-red-600">{{ error }}</p>
    <p v-else-if="help" class="text-xs leading-relaxed text-limpar-slate">{{ help }}</p>
  </div>
</template>
