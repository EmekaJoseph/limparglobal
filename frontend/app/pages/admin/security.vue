<script setup lang="ts">
definePageMeta({
  layout: 'admin',
  middleware: 'admin-auth'
})

useHead({ title: 'Security — Limpar Global Admin' })

const form = reactive({
  current_password: '',
  new_password: '',
  new_password_confirmation: ''
})

const saving = ref(false)
const saveMessage = ref('')
const saveSuccess = ref(false)
const errors = ref<Record<string, string[]>>({})

async function handleSubmit() {
  saving.value = true
  saveMessage.value = ''
  saveSuccess.value = false
  errors.value = {}

  try {
    await useAdminApi().put('/admin/security/password', form)
    saveSuccess.value = true
    saveMessage.value = 'Password updated. Other signed-in sessions have been logged out.'
    form.current_password = ''
    form.new_password = ''
    form.new_password_confirmation = ''
  } catch (err: any) {
    if (err.response?.status === 422) {
      errors.value = err.response.data.errors ?? {}
      saveMessage.value = err.response.data.message ?? 'Please fix the errors below.'
    } else {
      saveMessage.value = "Couldn't update your password."
    }
  } finally {
    saving.value = false
  }
}
</script>

<template>
  <div class="max-w-xl">
    <form class="rounded-2xl border border-limpar-pale-border bg-white p-6 shadow-subtle" @submit.prevent="handleSubmit">
      <p class="font-heading text-sm font-bold text-limpar-ink">Change password</p>
      <p class="mt-1 text-sm text-limpar-slate">Changing your password signs you out of every other device.</p>

      <p
        v-if="saveMessage"
        class="mt-4 rounded-lg px-3 py-2 text-sm"
        :class="saveSuccess ? 'bg-emerald-50 text-emerald-700' : 'bg-rose-50 text-rose-700'"
      >
        {{ saveMessage }}
      </p>

      <div class="mt-6 space-y-4">
        <div>
          <label for="current-password" class="mb-1.5 block text-sm font-medium text-limpar-ink">Current password</label>
          <PasswordInput id="current-password" v-model="form.current_password" required autocomplete="current-password" />
          <p v-if="errors.current_password" class="mt-1 text-xs text-rose-600">{{ errors.current_password[0] }}</p>
        </div>

        <div>
          <label for="new-password" class="mb-1.5 block text-sm font-medium text-limpar-ink">New password</label>
          <PasswordInput id="new-password" v-model="form.new_password" required :minlength="8" autocomplete="new-password" />
          <p v-if="errors.new_password" class="mt-1 text-xs text-rose-600">{{ errors.new_password[0] }}</p>
        </div>

        <div>
          <label for="new-password-confirmation" class="mb-1.5 block text-sm font-medium text-limpar-ink">Confirm new password</label>
          <PasswordInput id="new-password-confirmation" v-model="form.new_password_confirmation" required :minlength="8" autocomplete="new-password" />
        </div>
      </div>

      <button
        type="submit"
        class="mt-6 flex items-center gap-2 rounded-lg bg-limpar-deep px-4 py-2 text-sm font-semibold text-white transition-colors hover:bg-limpar-deep-dark disabled:opacity-60"
        :disabled="saving"
      >
        <AppIcon v-if="saving" name="spinner" class="h-4 w-4 animate-spin" />
        {{ saving ? 'Updating…' : 'Update password' }}
      </button>
    </form>
  </div>
</template>
