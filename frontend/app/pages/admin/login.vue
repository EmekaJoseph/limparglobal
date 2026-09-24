<script setup lang="ts">
import { inputClass } from '~/utils/formClasses'

definePageMeta({
  layout: false,
  middleware: 'admin-guest'
})

useHead({
  title: 'Admin Login — Limpar Global',
  meta: [{ name: 'robots', content: 'noindex, nofollow' }]
})

const { setSession } = useAdminAuth()

const form = reactive({ email: '', password: '' })
const submitting = ref(false)
const errors = ref<Record<string, string[]>>({})
const generalError = ref('')

async function handleSubmit() {
  submitting.value = true
  errors.value = {}
  generalError.value = ''

  try {
    const { data } = await useAdminApi().post('/login', form)
    setSession(data.token, data.admin)
    await navigateTo('/admin')
  } catch (err: any) {
    if (err.response?.status === 422) {
      errors.value = err.response.data.errors ?? {}
    } else if (err.response?.status === 429) {
      generalError.value = 'Too many attempts. Please wait a moment and try again.'
    } else {
      generalError.value = 'Could not reach the server. Please try again.'
    }
  } finally {
    submitting.value = false
  }
}
</script>

<template>
  <div class="flex min-h-screen items-center justify-center bg-limpar-ink px-4 py-12">
    <div class="w-full max-w-sm">
      <div class="mb-8 flex flex-col items-center text-center">
        <img src="/logo.png" alt="Limpar Global" class="h-12 w-12 rounded-xl bg-white/10 object-contain p-2">
        <p class="mt-4 font-heading text-lg font-bold text-white">Limpar Global</p>
        <p class="text-sm text-white/50">Admin dashboard</p>
      </div>

      <form class="rounded-2xl bg-white p-6 shadow-panel sm:p-8" @submit.prevent="handleSubmit">
        <h1 class="font-heading text-xl font-bold text-limpar-ink">Sign in</h1>
        <p class="mt-1 text-sm text-limpar-slate">Enter your admin credentials to continue.</p>

        <p v-if="generalError" class="mt-4 rounded-lg bg-rose-50 px-3 py-2 text-sm text-rose-700">
          {{ generalError }}
        </p>

        <div class="mt-6 space-y-4">
          <div>
            <label for="email" class="mb-1.5 block text-sm font-medium text-limpar-ink">Email</label>
            <input id="email" v-model="form.email" type="email" required autocomplete="username" :class="inputClass">
            <p v-if="errors.email" class="mt-1 text-xs text-rose-600">{{ errors.email[0] }}</p>
          </div>

          <div>
            <label for="password" class="mb-1.5 block text-sm font-medium text-limpar-ink">Password</label>
            <PasswordInput id="password" v-model="form.password" required autocomplete="current-password" />
            <p v-if="errors.password" class="mt-1 text-xs text-rose-600">{{ errors.password[0] }}</p>
          </div>
        </div>

        <button
          type="submit"
          class="mt-6 flex w-full items-center justify-center gap-2 rounded-lg bg-limpar-deep px-4 py-2.5 text-sm font-semibold text-white shadow-soft transition-colors hover:bg-limpar-deep-dark disabled:cursor-not-allowed disabled:opacity-60"
          :disabled="submitting"
        >
          <AppIcon v-if="submitting" name="spinner" class="h-4 w-4 animate-spin" />
          {{ submitting ? 'Signing in…' : 'Sign in' }}
        </button>
      </form>
    </div>
  </div>
</template>
