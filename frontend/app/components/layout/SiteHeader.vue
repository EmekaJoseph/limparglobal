<script setup lang="ts">
import { solutionLinks, mainNav } from '~/data/navigation'

const mobileOpen = ref(false)
const solutionsOpen = ref(false)
const mobileSolutionsOpen = ref(false)
const dropdownRef = ref<HTMLElement | null>(null)
const route = useRoute()
let closeTimeout: ReturnType<typeof setTimeout> | null = null

watch(() => route.fullPath, () => {
  mobileOpen.value = false
  solutionsOpen.value = false
  mobileSolutionsOpen.value = false
})

function handleClickOutside(event: MouseEvent) {
  if (dropdownRef.value && !dropdownRef.value.contains(event.target as Node)) {
    solutionsOpen.value = false
  }
}

function openOnHover() {
  if (closeTimeout) {
    clearTimeout(closeTimeout)
    closeTimeout = null
  }
  solutionsOpen.value = true
}

function closeOnHoverOut() {
  closeTimeout = setTimeout(() => {
    solutionsOpen.value = false
  }, 150)
}

onMounted(() => document.addEventListener('click', handleClickOutside))
onUnmounted(() => {
  document.removeEventListener('click', handleClickOutside)
  if (closeTimeout) clearTimeout(closeTimeout)
})
</script>

<template>
  <header class="sticky top-0 z-50 border-b border-limpar-pale-border bg-white/95 shadow-header backdrop-blur">
    <div class="mx-auto flex h-20 max-w-8xl items-center px-4 sm:px-6 lg:px-8">
      <NuxtLink to="/" class="flex items-center gap-3">
        <img src="/logo.png" alt="Limpar Global" class="h-11 w-11 rounded-lg object-cover shadow-subtle" width="512" height="512">
        <span class="font-heading text-lg font-bold text-limpar-ink">Limpar Global</span>
      </NuxtLink>

      <nav class="hidden items-center gap-8 lg:ml-14 lg:flex">
        <div ref="dropdownRef" class="relative" @mouseenter="openOnHover" @mouseleave="closeOnHoverOut">
          <button
            type="button"
            class="flex items-center gap-1 text-sm font-semibold text-limpar-ink/80 transition-colors hover:text-limpar-deep"
            :aria-expanded="solutionsOpen"
            @click="solutionsOpen = !solutionsOpen"
          >
            Solutions
            <AppIcon name="chevron-down" class="h-4 w-4 transition-transform" :class="{ 'rotate-180': solutionsOpen }" />
          </button>

          <Transition
            enter-active-class="transition ease-out duration-150"
            enter-from-class="opacity-0 -translate-y-1"
            enter-to-class="opacity-100 translate-y-0"
            leave-active-class="transition ease-in duration-100"
            leave-from-class="opacity-100 translate-y-0"
            leave-to-class="opacity-0 -translate-y-1"
          >
            <div v-if="solutionsOpen" class="absolute left-0 top-full mt-3 w-[22rem] rounded-2xl border border-limpar-pale-border bg-white p-2.5 shadow-card">
              <NuxtLink
                v-for="link in solutionLinks"
                :key="link.to"
                :to="link.to"
                class="flex flex-col gap-0.5 rounded-xl px-4 py-3 transition-colors hover:bg-limpar-pale"
              >
                <span class="text-sm font-semibold text-limpar-ink">{{ link.label }}</span>
                <span class="text-xs text-limpar-slate">{{ link.description }}</span>
              </NuxtLink>
            </div>
          </Transition>
        </div>

        <NuxtLink
          v-for="link in mainNav"
          :key="link.to"
          :to="link.to"
          class="text-sm font-semibold text-limpar-ink/80 transition-colors hover:text-limpar-deep"
          active-class="!text-limpar-deep"
        >
          {{ link.label }}
        </NuxtLink>
      </nav>

      <div class="ml-auto flex items-center gap-3">
        <NuxtLink
          to="/contact"
          class="hidden items-center rounded-lg bg-limpar-deep px-5 py-2.5 text-sm font-bold text-white shadow-soft transition-all hover:-translate-y-0.5 hover:bg-limpar-deep-dark hover:shadow-card lg:inline-flex"
        >
          Talk to Us
        </NuxtLink>

        <button
          type="button"
          class="h-6 w-6 text-limpar-ink lg:hidden"
          :aria-label="mobileOpen ? 'Close menu' : 'Open menu'"
          @click="mobileOpen = !mobileOpen"
        >
          <AppIcon :name="mobileOpen ? 'close' : 'menu'" class="h-6 w-6" />
        </button>
      </div>
    </div>

    <Transition
      enter-active-class="transition ease-out duration-200"
      enter-from-class="opacity-0 -translate-y-2"
      enter-to-class="opacity-100 translate-y-0"
      leave-active-class="transition ease-in duration-150"
      leave-from-class="opacity-100 translate-y-0"
      leave-to-class="opacity-0 -translate-y-2"
    >
      <div v-if="mobileOpen" class="border-t border-limpar-pale-border bg-white shadow-header lg:hidden">
        <nav class="flex flex-col px-4 py-4 sm:px-6">
          <button
            type="button"
            class="flex items-center justify-between border-b border-limpar-pale-border py-3 text-sm font-semibold text-limpar-ink"
            @click="mobileSolutionsOpen = !mobileSolutionsOpen"
          >
            Solutions
            <AppIcon name="chevron-down" class="h-4 w-4 transition-transform" :class="{ 'rotate-180': mobileSolutionsOpen }" />
          </button>
          <div v-if="mobileSolutionsOpen" class="flex flex-col gap-1 border-b border-limpar-pale-border py-2 pl-3">
            <NuxtLink
              v-for="link in solutionLinks"
              :key="link.to"
              :to="link.to"
              class="py-2 text-sm text-limpar-slate transition-colors hover:text-limpar-deep"
              active-class="!text-limpar-deep"
            >
              {{ link.label }}
            </NuxtLink>
          </div>

          <NuxtLink
            v-for="link in mainNav"
            :key="link.to"
            :to="link.to"
            class="border-b border-limpar-pale-border py-3 text-sm font-semibold text-limpar-ink last:border-none"
            active-class="!text-limpar-deep"
          >
            {{ link.label }}
          </NuxtLink>

          <NuxtLink
            to="/contact"
            class="mt-4 block rounded-lg bg-limpar-deep py-3 text-center text-sm font-bold text-white shadow-soft"
          >
            Talk to Us
          </NuxtLink>
        </nav>
      </div>
    </Transition>
  </header>
</template>
