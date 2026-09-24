interface AdminUser {
  id: number
  name: string
  email: string
}

const TOKEN_KEY = 'limpar_admin_token'
const ADMIN_KEY = 'limpar_admin_user'

// Admin section is fully client-rendered (see routeRules in nuxt.config.ts),
// so a plain module-scoped reactive singleton is safe here — there is no
// server-side render of this state to leak between users.
const token = ref<string | null>(null)
const admin = ref<AdminUser | null>(null)
let hydrated = false

function hydrate() {
  if (hydrated || !import.meta.client) return
  hydrated = true

  token.value = localStorage.getItem(TOKEN_KEY)
  const stored = localStorage.getItem(ADMIN_KEY)
  admin.value = stored ? JSON.parse(stored) : null
}

export function useAdminAuth() {
  hydrate()

  const isAuthenticated = computed(() => !!token.value)

  function setSession(newToken: string, newAdmin: AdminUser) {
    token.value = newToken
    admin.value = newAdmin
    if (import.meta.client) {
      localStorage.setItem(TOKEN_KEY, newToken)
      localStorage.setItem(ADMIN_KEY, JSON.stringify(newAdmin))
    }
  }

  function updateAdmin(newAdmin: AdminUser) {
    admin.value = newAdmin
    if (import.meta.client) localStorage.setItem(ADMIN_KEY, JSON.stringify(newAdmin))
  }

  function clearSession() {
    token.value = null
    admin.value = null
    if (import.meta.client) {
      localStorage.removeItem(TOKEN_KEY)
      localStorage.removeItem(ADMIN_KEY)
    }
  }

  return { token, admin, isAuthenticated, setSession, updateAdmin, clearSession }
}
