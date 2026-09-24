export default defineNuxtRouteMiddleware(() => {
  const { isAuthenticated } = useAdminAuth()

  if (!isAuthenticated.value) {
    return navigateTo('/admin/login')
  }
})
