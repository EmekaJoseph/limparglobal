<script setup lang="ts">
withDefaults(defineProps<{
  caption?: string
}>(), {
  caption: 'Visual / photography placeholder'
})
</script>

<template>
  <div class="relative w-full overflow-hidden rounded-3xl bg-gradient-to-br from-limpar-pale to-[#CDE9F8] shadow-panel">
    <div class="absolute left-[8%] top-[10%] aspect-square w-[38%] rounded-3xl bg-limpar-deep opacity-95 shadow-card" />
    <div class="absolute bottom-[8%] right-[8%] aspect-square w-[30%] rounded-3xl bg-limpar-sky opacity-90 shadow-card" />
    <div class="absolute left-[42%] top-[28%] aspect-square w-[22%] rounded-2xl bg-white shadow-lifted" />
    <span class="absolute bottom-4 left-5 text-xs font-medium text-limpar-ink/40">[ {{ caption }} ]</span>
  </div>
</template>
