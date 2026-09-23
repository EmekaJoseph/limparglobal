<script setup lang="ts">
const props = defineProps<{
  steps: { id: string; label: string }[]
}>()

const activeIndex = ref(0)
const ANCHOR_OFFSET = 212
let ticking = false

function scrollToStep(id: string) {
  document.getElementById(id)?.scrollIntoView({ behavior: 'smooth', block: 'start' })
}

function updateActiveStep() {
  const doc = document.documentElement
  const atBottom = window.scrollY + window.innerHeight >= doc.scrollHeight - 4
  if (atBottom) {
    activeIndex.value = props.steps.length - 1
    return
  }

  let current = 0
  for (let i = 0; i < props.steps.length; i++) {
    const el = document.getElementById(props.steps[i].id)
    if (el && el.getBoundingClientRect().top <= ANCHOR_OFFSET) current = i
  }
  activeIndex.value = current
}

function onScroll() {
  if (ticking) return
  ticking = true
  requestAnimationFrame(() => {
    updateActiveStep()
    ticking = false
  })
}

onMounted(() => {
  updateActiveStep()
  window.addEventListener('scroll', onScroll, { passive: true })
  window.addEventListener('resize', onScroll)
})

onUnmounted(() => {
  window.removeEventListener('scroll', onScroll)
  window.removeEventListener('resize', onScroll)
})

const progressPercent = computed(() => {
  if (props.steps.length <= 1) return 100
  return (activeIndex.value / (props.steps.length - 1)) * 100
})
</script>

<template>
  <div class="sticky top-24 z-30 mb-10 rounded-2xl border border-limpar-pale-border bg-white/95 p-4 shadow-card backdrop-blur">
    <div class="flex items-center justify-between gap-4 text-xs font-semibold uppercase tracking-wide text-limpar-slate">
      <span>Step {{ activeIndex + 1 }} of {{ steps.length }}</span>
      <span class="truncate text-limpar-deep">{{ steps[activeIndex]?.label }}</span>
    </div>
    <div class="mt-2.5 h-1.5 w-full overflow-hidden rounded-full bg-limpar-pale">
      <div
        class="h-full rounded-full bg-limpar-deep transition-all duration-300 ease-out"
        :style="{ width: `${progressPercent}%` }"
      />
    </div>
    <div class="mt-3 hidden gap-1 lg:flex">
      <button
        v-for="(step, i) in steps"
        :key="step.id"
        type="button"
        class="flex-1 rounded-full py-1 text-center text-[11px] font-bold transition-colors"
        :class="i <= activeIndex ? 'text-limpar-deep' : 'text-limpar-slate/40 hover:text-limpar-slate'"
        :aria-current="i === activeIndex ? 'step' : undefined"
        @click="scrollToStep(step.id)"
      >
        {{ i + 1 }}
      </button>
    </div>
  </div>
</template>
