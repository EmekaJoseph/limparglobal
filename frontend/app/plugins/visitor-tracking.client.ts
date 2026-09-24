// Logs each page view to the backend for the admin Visitors dashboard.
// Client-only (.client.ts) so it never runs during static prerendering.
// Best-effort: a failed/blocked request must never affect the visitor.
export default defineNuxtPlugin(() => {
  const router = useRouter()
  let lastTracked = ''

  function track(fullPath: string) {
    if (fullPath.startsWith('/admin')) return
    if (fullPath === lastTracked) return
    lastTracked = fullPath

    useApi().post('/track-visit', {
      path: fullPath,
      referrer: document.referrer || undefined
    }).catch(() => {
      // Backend unreachable, rate-limited, etc. — nothing to do here.
    })
  }

  // Fires for the initial route resolution on load as well as every
  // subsequent client-side navigation.
  router.afterEach((to) => {
    track(to.fullPath)
  })
})
