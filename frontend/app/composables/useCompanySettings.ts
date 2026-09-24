import { company as companyDefaults } from '~/data/company'

// Reactive company info, seeded with the hardcoded defaults above. On the
// client we try to overlay the live email/linkedin from the backend
// (site owner can update these without a redeploy); if that request fails
// or never resolves (e.g. static build, backend offline), the defaults
// stand as-is — the public site must never show blank contact info.
const state = reactive({ ...companyDefaults })
let requested = false

export function useCompanySettings() {
  if (import.meta.client && !requested) {
    requested = true
    useApi().get('/settings')
      .then(({ data }) => {
        if (data?.email) state.email = data.email
        if (data?.linkedin) state.linkedin = data.linkedin
      })
      .catch(() => {
        // Backend unreachable — keep the hardcoded defaults.
      })
  }

  return state
}
