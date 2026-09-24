<script setup lang="ts">
const route = useRoute()
const { admin, clearSession } = useAdminAuth()

useHead({
  meta: [{ name: 'robots', content: 'noindex, nofollow' }]
})

const navigation = [
  { label: 'Dashboard', to: '/admin', icon: 'grid' },
  { label: 'Talent Applications', to: '/admin/talent-applications', icon: 'users' },
  { label: 'Employer Requests', to: '/admin/employer-requests', icon: 'briefcase' },
  { label: 'Visitors', to: '/admin/visitors', icon: 'globe' },
  { label: 'Settings', to: '/admin/settings', icon: 'settings' },
  { label: 'Security', to: '/admin/security', icon: 'lock' }
]

function isActive(to: string) {
  if (to === '/admin') return route.path === '/admin'
  return route.path.startsWith(to)
}

const currentLabel = computed(() => navigation.find(item => isActive(item.to))?.label ?? 'Admin')
const mobileNavOpen = ref(false)
const loggingOut = ref(false)

async function handleLogout() {
  loggingOut.value = true
  try {
    await useAdminApi().post('/logout')
  } catch {
    // Token may already be invalid server-side — clear locally regardless.
  }
  clearSession()
  await navigateTo('/admin/login')
}
</script>

<template>
  <div class="flex min-h-screen bg-limpar-pale/40">
    <aside class="hidden w-64 shrink-0 flex-col bg-limpar-ink text-white lg:flex">
      <div class="flex items-center gap-2.5 px-6 py-6">
        <img src="/logo.png" alt="Limpar Global" class="h-8 w-8 rounded-md bg-white/10 object-contain p-1">
        <div>
          <p class="font-heading text-sm font-bold leading-tight">Limpar Global</p>
          <p class="text-xs text-white/50">Admin dashboard</p>
        </div>
      </div>

      <nav class="flex-1 space-y-1 px-3">
        <NuxtLink
          v-for="item in navigation"
          :key="item.to"
          :to="item.to"
          class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-colors"
          :class="isActive(item.to) ? 'bg-limpar-deep text-white shadow-soft' : 'text-white/70 hover:bg-white/5 hover:text-white'"
        >
          <AppIcon :name="item.icon" class="h-5 w-5 shrink-0" />
          {{ item.label }}
        </NuxtLink>
      </nav>

      <div class="border-t border-white/10 px-3 py-4">
        <button
          type="button"
          class="flex w-full items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium text-white/70 transition-colors hover:bg-white/5 hover:text-white disabled:opacity-60"
          :disabled="loggingOut"
          @click="handleLogout"
        >
          <AppIcon name="logout" class="h-5 w-5" />
          {{ loggingOut ? 'Logging out…' : 'Log out' }}
        </button>
      </div>
    </aside>

    <div class="flex min-w-0 flex-1 flex-col">
      <header class="flex items-center justify-between border-b border-limpar-pale-border bg-white px-4 py-3 lg:px-8">
        <button type="button" class="rounded-lg p-2 text-limpar-ink lg:hidden" @click="mobileNavOpen = true">
          <AppIcon name="menu" class="h-5 w-5" />
        </button>
        <p class="hidden font-heading text-base font-bold text-limpar-ink lg:block">{{ currentLabel }}</p>
        <div class="flex items-center gap-3">
          <span class="hidden text-sm text-limpar-slate sm:inline">{{ admin?.name }}</span>
          <span class="flex h-9 w-9 items-center justify-center rounded-full bg-limpar-pale text-sm font-semibold text-limpar-deep">
            {{ admin?.name?.charAt(0) ?? 'A' }}
          </span>
        </div>
      </header>

      <main class="flex-1 px-4 py-6 lg:px-8 lg:py-8">
        <slot />
      </main>
    </div>

    <Teleport to="body">
      <div v-if="mobileNavOpen" class="fixed inset-0 z-50 lg:hidden">
        <div class="absolute inset-0 bg-limpar-ink/50" @click="mobileNavOpen = false" />
        <div class="absolute inset-y-0 left-0 flex w-64 flex-col bg-limpar-ink text-white">
          <div class="flex items-center justify-between px-6 py-6">
            <p class="font-heading text-sm font-bold">Limpar Admin</p>
            <button type="button" class="text-white/70" @click="mobileNavOpen = false">
              <AppIcon name="close" class="h-5 w-5" />
            </button>
          </div>
          <nav class="flex-1 space-y-1 px-3">
            <NuxtLink
              v-for="item in navigation"
              :key="item.to"
              :to="item.to"
              class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-colors"
              :class="isActive(item.to) ? 'bg-limpar-deep text-white' : 'text-white/70 hover:bg-white/5 hover:text-white'"
              @click="mobileNavOpen = false"
            >
              <AppIcon :name="item.icon" class="h-5 w-5 shrink-0" />
              {{ item.label }}
            </NuxtLink>
          </nav>
          <div class="border-t border-white/10 px-3 py-4">
            <button
              type="button"
              class="flex w-full items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium text-white/70 hover:bg-white/5 hover:text-white"
              @click="handleLogout"
            >
              <AppIcon name="logout" class="h-5 w-5" />
              Log out
            </button>
          </div>
        </div>
      </div>
    </Teleport>
  </div>
</template>
