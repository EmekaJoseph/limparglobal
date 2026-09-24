import axios from 'axios'

let client: ReturnType<typeof axios.create> | null = null

// Configured axios instance pointed at the Laravel API (runtimeConfig.public.apiBaseUrl).
export function useApi() {
  if (!client) {
    const { apiBaseUrl } = useRuntimeConfig().public
    client = axios.create({
      baseURL: apiBaseUrl,
      headers: { Accept: 'application/json' }
    })
  }
  return client
}
