// For the login page: bounce back to the dashboard if already signed in.
export default defineNuxtRouteMiddleware(() => {
  const { isAuthenticated } = useAdminAuth()

  if (isAuthenticated.value) {
    return navigateTo('/admin')
  }
})
