<script setup lang="ts">
import { inputClass } from '~/utils/formClasses'

definePageMeta({
  layout: 'admin',
  middleware: 'admin-auth'
})

useHead({ title: 'Settings — Limpar Global Admin' })

const form = reactive({ email: '', phone: '', linkedin: '' })
const loading = ref(true)
const loadError = ref(false)
const saving = ref(false)
const saveMessage = ref('')
const errors = ref<Record<string, string[]>>({})

async function load() {
  loading.value = true
  loadError.value = false
  try {
    const { data } = await useAdminApi().get('/admin/settings')
    form.email = data.email ?? ''
    form.phone = data.phone ?? ''
    form.linkedin = data.linkedin ?? ''
  } catch {
    loadError.value = true
  } finally {
    loading.value = false
  }
}

onMounted(load)

async function handleSubmit() {
  saving.value = true
  saveMessage.value = ''
  errors.value = {}
  try {
    await useAdminApi().put('/admin/settings', form)
    saveMessage.value = 'Settings saved. These changes are what the public site now shows.'
  } catch (err: any) {
    if (err.response?.status === 422) {
      errors.value = err.response.data.errors ?? {}
    } else {
      saveMessage.value = "Couldn't save settings."
    }
  } finally {
    saving.value = false
  }
}
</script>

<template>
  <div class="max-w-xl">
    <div v-if="loading" class="flex items-center justify-center py-24 text-limpar-slate">
      <AppIcon name="spinner" class="h-5 w-5 animate-spin" />
    </div>

    <div v-else-if="loadError" class="rounded-2xl border border-rose-200 bg-rose-50 px-5 py-8 text-center text-sm text-rose-700">
      Couldn't load settings. <button type="button" class="font-semibold underline" @click="load">Try again</button>
    </div>

    <form v-else class="rounded-2xl border border-limpar-pale-border bg-white p-6 shadow-subtle" @submit.prevent="handleSubmit">
      <p class="font-heading text-sm font-bold text-limpar-ink">Public contact details</p>
      <p class="mt-1 text-sm text-limpar-slate">Shown across the site footer and contact page. Leave a field blank to hide it publicly.</p>

      <div class="mt-6 space-y-4">
        <div>
          <label for="settings-email" class="mb-1.5 block text-sm font-medium text-limpar-ink">Contact email</label>
          <input id="settings-email" v-model="form.email" type="email" :class="inputClass">
          <p v-if="errors.email" class="mt-1 text-xs text-rose-600">{{ errors.email[0] }}</p>
        </div>

        <div>
          <label for="settings-phone" class="mb-1.5 block text-sm font-medium text-limpar-ink">Phone number</label>
          <input id="settings-phone" v-model="form.phone" type="text" placeholder="+234…" :class="inputClass">
          <p v-if="errors.phone" class="mt-1 text-xs text-rose-600">{{ errors.phone[0] }}</p>
        </div>

        <div>
          <label for="settings-linkedin" class="mb-1.5 block text-sm font-medium text-limpar-ink">LinkedIn URL</label>
          <input id="settings-linkedin" v-model="form.linkedin" type="url" placeholder="https://www.linkedin.com/company/…" :class="inputClass">
          <p v-if="errors.linkedin" class="mt-1 text-xs text-rose-600">{{ errors.linkedin[0] }}</p>
        </div>
      </div>

      <div class="mt-6 flex items-center gap-3">
        <button
          type="submit"
          class="flex items-center gap-2 rounded-lg bg-limpar-deep px-4 py-2 text-sm font-semibold text-white transition-colors hover:bg-limpar-deep-dark disabled:opacity-60"
          :disabled="saving"
        >
          <AppIcon v-if="saving" name="spinner" class="h-4 w-4 animate-spin" />
          {{ saving ? 'Saving…' : 'Save settings' }}
        </button>
        <span v-if="saveMessage" class="text-sm text-limpar-slate">{{ saveMessage }}</span>
      </div>
    </form>
  </div>
</template>
