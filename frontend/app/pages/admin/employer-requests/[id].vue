<script setup lang="ts">
import { selectClass, textareaClass } from '~/utils/formClasses'

definePageMeta({
  layout: 'admin',
  middleware: 'admin-auth'
})

interface EmployerRequest {
  id: number
  organisation_name: string
  website: string | null
  industry: string
  location: string
  contact_name: string
  job_title: string
  email: string
  phone: string
  support_types: string[]
  talent_areas: string[]
  roles: string
  headcount: number
  timeline: string
  experience_level: string
  work_arrangement: string
  talent_location: string
  role_description: string
  key_skills: string
  has_jd: string
  has_jd_file: boolean
  jd_original_name: string | null
  help_needed: string[]
  anything_else: string | null
  review_status: string
  admin_notes: string | null
  ip_address: string | null
  created_at: string | null
}

const route = useRoute()
const id = route.params.id

const record = ref<EmployerRequest | null>(null)
const loading = ref(true)
const loadError = ref(false)
const saving = ref(false)
const deleting = ref(false)
const saveMessage = ref('')

const reviewStatus = ref('new')
const adminNotes = ref('')

async function load() {
  loading.value = true
  loadError.value = false
  try {
    const { data } = await useAdminApi().get<EmployerRequest>(`/admin/employer-requests/${id}`)
    record.value = data
    reviewStatus.value = data.review_status
    adminNotes.value = data.admin_notes ?? ''
  } catch {
    loadError.value = true
  } finally {
    loading.value = false
  }
}

onMounted(load)

async function handleSave() {
  saving.value = true
  saveMessage.value = ''
  try {
    const { data } = await useAdminApi().patch<EmployerRequest>(`/admin/employer-requests/${id}`, {
      review_status: reviewStatus.value,
      admin_notes: adminNotes.value
    })
    record.value = data
    saveMessage.value = 'Saved.'
    setTimeout(() => { saveMessage.value = '' }, 2500)
  } catch {
    saveMessage.value = "Couldn't save changes."
  } finally {
    saving.value = false
  }
}

async function handleDelete() {
  if (!confirm('Delete this request and its job description file? This cannot be undone.')) return
  deleting.value = true
  try {
    await useAdminApi().delete(`/admin/employer-requests/${id}`)
    await navigateTo('/admin/employer-requests')
  } catch {
    deleting.value = false
    alert("Couldn't delete this request.")
  }
}

async function handleDownloadJd() {
  const response = await useAdminApi().get(`/admin/employer-requests/${id}/jd`, { responseType: 'blob' })
  const url = URL.createObjectURL(new Blob([response.data]))
  const link = document.createElement('a')
  link.href = url
  link.download = record.value?.jd_original_name ?? 'job-description.pdf'
  link.click()
  URL.revokeObjectURL(url)
}

function formatDate(value: string | null) {
  if (!value) return '—'
  return new Date(value).toLocaleString('en-GB', { day: 'numeric', month: 'short', year: 'numeric', hour: '2-digit', minute: '2-digit' })
}
</script>

<template>
  <div>
    <NuxtLink to="/admin/employer-requests" class="mb-5 inline-flex items-center gap-1.5 text-sm font-semibold text-limpar-deep hover:underline">
      <AppIcon name="arrow-left" class="h-4 w-4" />
      Back to employer requests
    </NuxtLink>

    <div v-if="loading" class="flex items-center justify-center py-24 text-limpar-slate">
      <AppIcon name="spinner" class="h-5 w-5 animate-spin" />
    </div>

    <div v-else-if="loadError || !record" class="rounded-2xl border border-rose-200 bg-rose-50 px-5 py-8 text-center text-sm text-rose-700">
      Couldn't load this request. <button type="button" class="font-semibold underline" @click="load">Try again</button>
    </div>

    <div v-else class="space-y-6">
      <div class="flex flex-wrap items-start justify-between gap-4 rounded-2xl border border-limpar-pale-border bg-white p-5 shadow-subtle">
        <div>
          <div class="flex items-center gap-3">
            <h1 class="font-heading text-xl font-bold text-limpar-ink">{{ record.organisation_name }}</h1>
            <AdminStatusBadge :status="record.review_status" />
          </div>
          <p class="mt-1 text-sm text-limpar-slate">Submitted {{ formatDate(record.created_at) }} &middot; {{ record.ip_address ?? 'unknown IP' }}</p>
        </div>
        <button
          type="button"
          class="flex items-center gap-2 rounded-lg border border-rose-200 px-3 py-2 text-sm font-semibold text-rose-600 transition-colors hover:bg-rose-50 disabled:opacity-60"
          :disabled="deleting"
          @click="handleDelete"
        >
          <AppIcon name="trash" class="h-4 w-4" />
          {{ deleting ? 'Deleting…' : 'Delete' }}
        </button>
      </div>

      <div class="rounded-2xl border border-limpar-pale-border bg-white p-5 shadow-subtle">
        <p class="mb-4 font-heading text-sm font-bold text-limpar-ink">Organisation &amp; contact</p>
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
          <AdminDetailField label="Industry">{{ record.industry }}</AdminDetailField>
          <AdminDetailField label="Location">{{ record.location }}</AdminDetailField>
          <AdminDetailField v-if="record.website" label="Website"><a :href="record.website" target="_blank" rel="noopener noreferrer" class="text-limpar-deep hover:underline">{{ record.website }}</a></AdminDetailField>
          <AdminDetailField label="Contact name">{{ record.contact_name }}</AdminDetailField>
          <AdminDetailField label="Contact role">{{ record.job_title }}</AdminDetailField>
          <AdminDetailField label="Email"><a :href="`mailto:${record.email}`" class="text-limpar-deep hover:underline">{{ record.email }}</a></AdminDetailField>
          <AdminDetailField label="Phone">{{ record.phone }}</AdminDetailField>
        </div>
      </div>

      <div class="rounded-2xl border border-limpar-pale-border bg-white p-5 shadow-subtle">
        <p class="mb-4 font-heading text-sm font-bold text-limpar-ink">Support needed</p>
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
          <AdminDetailField label="Support types" span>
            <div class="flex flex-wrap gap-1.5">
              <span v-for="item in record.support_types" :key="item" class="rounded-full bg-limpar-pale px-2.5 py-1 text-xs font-medium text-limpar-deep">{{ item }}</span>
            </div>
          </AdminDetailField>
          <AdminDetailField label="Talent areas" span>
            <div class="flex flex-wrap gap-1.5">
              <span v-for="item in record.talent_areas" :key="item" class="rounded-full bg-limpar-pale px-2.5 py-1 text-xs font-medium text-limpar-deep">{{ item }}</span>
            </div>
          </AdminDetailField>
        </div>
      </div>

      <div class="rounded-2xl border border-limpar-pale-border bg-white p-5 shadow-subtle">
        <p class="mb-4 font-heading text-sm font-bold text-limpar-ink">Role details</p>
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
          <AdminDetailField label="Roles">{{ record.roles }}</AdminDetailField>
          <AdminDetailField label="Headcount">{{ record.headcount }}</AdminDetailField>
          <AdminDetailField label="Timeline">{{ record.timeline }}</AdminDetailField>
          <AdminDetailField label="Experience level">{{ record.experience_level }}</AdminDetailField>
          <AdminDetailField label="Work arrangement">{{ record.work_arrangement }}</AdminDetailField>
          <AdminDetailField label="Talent location">{{ record.talent_location }}</AdminDetailField>
          <AdminDetailField label="Role description" span>{{ record.role_description }}</AdminDetailField>
          <AdminDetailField label="Key skills" span>{{ record.key_skills }}</AdminDetailField>
        </div>
        <div class="mt-4 flex items-center justify-between rounded-xl bg-limpar-pale/50 px-4 py-3 text-xs text-limpar-slate">
          <span>Job description on file: <strong class="text-limpar-ink">{{ record.has_jd }}</strong></span>
          <button
            v-if="record.has_jd_file"
            type="button"
            class="flex items-center gap-1.5 font-semibold text-limpar-deep hover:underline"
            @click="handleDownloadJd"
          >
            <AppIcon name="download" class="h-3.5 w-3.5" />
            Download {{ record.jd_original_name ? `(${record.jd_original_name})` : 'file' }}
          </button>
        </div>
      </div>

      <div class="rounded-2xl border border-limpar-pale-border bg-white p-5 shadow-subtle">
        <p class="mb-4 font-heading text-sm font-bold text-limpar-ink">Additional support</p>
        <div class="grid grid-cols-1 gap-4">
          <AdminDetailField label="Help needed">
            <div class="flex flex-wrap gap-1.5">
              <span v-for="item in record.help_needed" :key="item" class="rounded-full bg-limpar-pale px-2.5 py-1 text-xs font-medium text-limpar-deep">{{ item }}</span>
            </div>
          </AdminDetailField>
          <AdminDetailField v-if="record.anything_else" label="Anything else">{{ record.anything_else }}</AdminDetailField>
        </div>
      </div>

      <AdminEmailComposer
        :endpoint="`/admin/employer-requests/${id}/message`"
        :recipient-name="record.contact_name"
        :recipient-email="record.email"
        default-subject="Your request to Limpar Global"
      />

      <div class="rounded-2xl border border-limpar-pale-border bg-white p-5 shadow-subtle">
        <p class="mb-4 font-heading text-sm font-bold text-limpar-ink">Review</p>
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-[200px_1fr]">
          <div>
            <label class="mb-1.5 block text-sm font-medium text-limpar-ink">Status</label>
            <select v-model="reviewStatus" :class="selectClass">
              <option value="new">New</option>
              <option value="contacted">Contacted</option>
              <option value="in_progress">In progress</option>
              <option value="closed">Closed</option>
            </select>
          </div>
          <div>
            <label class="mb-1.5 block text-sm font-medium text-limpar-ink">Internal notes</label>
            <textarea v-model="adminNotes" rows="3" :class="textareaClass" placeholder="Notes only visible to admins…" />
          </div>
        </div>
        <div class="mt-4 flex items-center gap-3">
          <button
            type="button"
            class="flex items-center gap-2 rounded-lg bg-limpar-deep px-4 py-2 text-sm font-semibold text-white transition-colors hover:bg-limpar-deep-dark disabled:opacity-60"
            :disabled="saving"
            @click="handleSave"
          >
            <AppIcon v-if="saving" name="spinner" class="h-4 w-4 animate-spin" />
            {{ saving ? 'Saving…' : 'Save changes' }}
          </button>
          <span v-if="saveMessage" class="text-sm text-limpar-slate">{{ saveMessage }}</span>
        </div>
      </div>
    </div>
  </div>
</template>
