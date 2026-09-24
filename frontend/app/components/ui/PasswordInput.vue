<script setup lang="ts">
import { inputClass } from '~/utils/formClasses'

defineProps<{
  id: string
  modelValue: string
  required?: boolean
  minlength?: number
  autocomplete?: string
}>()

defineEmits<{
  'update:modelValue': [value: string]
}>()

const visible = ref(false)
</script>

<template>
  <div class="relative">
    <input
      :id="id"
      :type="visible ? 'text' : 'password'"
      :value="modelValue"
      :required="required"
      :minlength="minlength"
      :autocomplete="autocomplete"
      :class="`${inputClass} pr-10`"
      @input="$emit('update:modelValue', ($event.target as HTMLInputElement).value)"
    >
    <button
      type="button"
      tabindex="-1"
      class="absolute right-3 top-1/2 -translate-y-1/2 text-limpar-slate transition-colors hover:text-limpar-deep"
      :aria-label="visible ? 'Hide password' : 'Show password'"
      @click="visible = !visible"
    >
      <AppIcon :name="visible ? 'eye-off' : 'eye'" class="h-4 w-4" />
    </button>
  </div>
</template>
