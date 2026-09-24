import axios from 'axios'

let client: ReturnType<typeof axios.create> | null = null

// Same Laravel API as useApi(), but attaches the admin's Sanctum bearer
// token to every request and logs the admin out on a 401 (expired/revoked
// token) by redirecting to the login screen.
export function useAdminApi() {
  if (!client) {
    const { apiBaseUrl } = useRuntimeConfig().public
    client = axios.create({
      baseURL: apiBaseUrl,
      headers: { Accept: 'application/json' }
    })

    client.interceptors.request.use((config) => {
      const { token } = useAdminAuth()
      if (token.value) {
        config.headers.Authorization = `Bearer ${token.value}`
      }
      return config
    })

    client.interceptors.response.use(
      (response) => response,
      (error) => {
        if (error.response?.status === 401) {
          const { clearSession } = useAdminAuth()
          clearSession()
          navigateTo('/admin/login')
        }
        return Promise.reject(error)
      }
    )
  }

  return client
}
