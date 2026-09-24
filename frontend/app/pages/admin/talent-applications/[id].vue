<script setup lang="ts">
import { selectClass, textareaClass } from '~/utils/formClasses'

definePageMeta({
  layout: 'admin',
  middleware: 'admin-auth'
})

interface TalentApplication {
  id: number
  full_name: string
  email: string
  phone: string
  country: string
  city_state: string
  linkedin: string
  portfolio: string | null
  professional_status: string
  experience_range: string
  job_title: string
  industry: string
  has_cv: boolean
  cv_original_name: string | null
  area_of_interest: string
  specific_roles: string
  current_level: string
  skills: string[]
  tools: string
  proud_project: string
  opportunity_type: string
  work_arrangement: string
  preferred_location: string
  skill_gap: string
  learning_goal: string
  hours_per_week: string
  willing_assessment: string
  willing_shared: string
  why_join: string
  strong_candidate: string
  anything_else: string | null
  applicant_name: string
  declaration_date: string | null
  review_status: string
  admin_notes: string | null
  ip_address: string | null
  created_at: string | null
}

const route = useRoute()
const id = route.params.id

const record = ref<TalentApplication | null>(null)
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
    const { data } = await useAdminApi().get<TalentApplication>(`/admin/talent-applications/${id}`)
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
    const { data } = await useAdminApi().patch<TalentApplication>(`/admin/talent-applications/${id}`, {
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
  if (!confirm('Delete this application and its CV? This cannot be undone.')) return
  deleting.value = true
  try {
    await useAdminApi().delete(`/admin/talent-applications/${id}`)
    await navigateTo('/admin/talent-applications')
  } catch {
    deleting.value = false
    alert("Couldn't delete this application.")
  }
}

async function handleDownloadCv() {
  const response = await useAdminApi().get(`/admin/talent-applications/${id}/cv`, { responseType: 'blob' })
  const url = URL.createObjectURL(new Blob([response.data]))
  const link = document.createElement('a')
  link.href = url
  link.download = record.value?.cv_original_name ?? 'cv.pdf'
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
    <NuxtLink to="/admin/talent-applications" class="mb-5 inline-flex items-center gap-1.5 text-sm font-semibold text-limpar-deep hover:underline">
      <AppIcon name="arrow-left" class="h-4 w-4" />
      Back to applications
    </NuxtLink>

    <div v-if="loading" class="flex items-center justify-center py-24 text-limpar-slate">
      <AppIcon name="spinner" class="h-5 w-5 animate-spin" />
    </div>

    <div v-else-if="loadError || !record" class="rounded-2xl border border-rose-200 bg-rose-50 px-5 py-8 text-center text-sm text-rose-700">
      Couldn't load this application. <button type="button" class="font-semibold underline" @click="load">Try again</button>
    </div>

    <div v-else class="space-y-6">
      <div class="flex flex-wrap items-start justify-between gap-4 rounded-2xl border border-limpar-pale-border bg-white p-5 shadow-subtle">
        <div>
          <div class="flex items-center gap-3">
            <h1 class="font-heading text-xl font-bold text-limpar-ink">{{ record.full_name }}</h1>
            <AdminStatusBadge :status="record.review_status" />
          </div>
          <p class="mt-1 text-sm text-limpar-slate">Applied {{ formatDate(record.created_at) }} &middot; {{ record.ip_address ?? 'unknown IP' }}</p>
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
        <p class="mb-4 font-heading text-sm font-bold text-limpar-ink">Contact &amp; background</p>
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
          <AdminDetailField label="Email"><a :href="`mailto:${record.email}`" class="text-limpar-deep hover:underline">{{ record.email }}</a></AdminDetailField>
          <AdminDetailField label="Phone">{{ record.phone }}</AdminDetailField>
          <AdminDetailField label="Location">{{ record.city_state }}, {{ record.country }}</AdminDetailField>
          <AdminDetailField label="LinkedIn"><a :href="record.linkedin" target="_blank" rel="noopener noreferrer" class="text-limpar-deep hover:underline">{{ record.linkedin }}</a></AdminDetailField>
          <AdminDetailField v-if="record.portfolio" label="Portfolio"><a :href="record.portfolio" target="_blank" rel="noopener noreferrer" class="text-limpar-deep hover:underline">{{ record.portfolio }}</a></AdminDetailField>
          <AdminDetailField label="Professional status">{{ record.professional_status }}</AdminDetailField>
          <AdminDetailField label="Experience">{{ record.experience_range }}</AdminDetailField>
          <AdminDetailField label="Current role">{{ record.job_title }}</AdminDetailField>
          <AdminDetailField label="Industry">{{ record.industry }}</AdminDetailField>
        </div>
      </div>

      <div class="rounded-2xl border border-limpar-pale-border bg-white p-5 shadow-subtle">
        <p class="mb-4 font-heading text-sm font-bold text-limpar-ink">Interest &amp; skills</p>
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
          <AdminDetailField label="Area of interest">{{ record.area_of_interest }}</AdminDetailField>
          <AdminDetailField label="Current level">{{ record.current_level }}</AdminDetailField>
          <AdminDetailField label="Specific roles" span>{{ record.specific_roles }}</AdminDetailField>
          <AdminDetailField label="Skills" span>
            <div class="flex flex-wrap gap-1.5">
              <span v-for="skill in record.skills" :key="skill" class="rounded-full bg-limpar-pale px-2.5 py-1 text-xs font-medium text-limpar-deep">{{ skill }}</span>
            </div>
          </AdminDetailField>
          <AdminDetailField label="Tools" span>{{ record.tools }}</AdminDetailField>
          <AdminDetailField label="A project they're proud of" span>{{ record.proud_project }}</AdminDetailField>
        </div>
      </div>

      <div class="rounded-2xl border border-limpar-pale-border bg-white p-5 shadow-subtle">
        <p class="mb-4 font-heading text-sm font-bold text-limpar-ink">Work preferences</p>
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
          <AdminDetailField label="Opportunity type">{{ record.opportunity_type }}</AdminDetailField>
          <AdminDetailField label="Work arrangement">{{ record.work_arrangement }}</AdminDetailField>
          <AdminDetailField label="Preferred location">{{ record.preferred_location }}</AdminDetailField>
          <AdminDetailField label="Hours per week">{{ record.hours_per_week }}</AdminDetailField>
          <AdminDetailField label="Open to assessment">{{ record.willing_assessment }}</AdminDetailField>
          <AdminDetailField label="Open to profile sharing">{{ record.willing_shared }}</AdminDetailField>
          <AdminDetailField label="Skill gap" span>{{ record.skill_gap }}</AdminDetailField>
          <AdminDetailField label="Learning goal" span>{{ record.learning_goal }}</AdminDetailField>
        </div>
      </div>

      <div class="rounded-2xl border border-limpar-pale-border bg-white p-5 shadow-subtle">
        <p class="mb-4 font-heading text-sm font-bold text-limpar-ink">In their own words</p>
        <div class="grid grid-cols-1 gap-4">
          <AdminDetailField label="Why they want to join">{{ record.why_join }}</AdminDetailField>
          <AdminDetailField label="Why they'd be a strong candidate">{{ record.strong_candidate }}</AdminDetailField>
          <AdminDetailField v-if="record.anything_else" label="Anything else">{{ record.anything_else }}</AdminDetailField>
        </div>
        <div class="mt-5 flex flex-wrap items-center justify-between gap-3 rounded-xl bg-limpar-pale/50 px-4 py-3 text-xs text-limpar-slate">
          <span>Declared by <strong class="text-limpar-ink">{{ record.applicant_name }}</strong> on {{ record.declaration_date ?? '—' }}</span>
          <button
            v-if="record.has_cv"
            type="button"
            class="flex items-center gap-1.5 font-semibold text-limpar-deep hover:underline"
            @click="handleDownloadCv"
          >
            <AppIcon name="download" class="h-3.5 w-3.5" />
            Download CV {{ record.cv_original_name ? `(${record.cv_original_name})` : '' }}
          </button>
        </div>
      </div>

      <AdminEmailComposer
        :endpoint="`/admin/talent-applications/${id}/message`"
        :recipient-name="record.full_name"
        :recipient-email="record.email"
        default-subject="Your application to Limpar Global"
      />

      <div class="rounded-2xl border border-limpar-pale-border bg-white p-5 shadow-subtle">
        <p class="mb-4 font-heading text-sm font-bold text-limpar-ink">Review</p>
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-[200px_1fr]">
          <div>
            <label class="mb-1.5 block text-sm font-medium text-limpar-ink">Status</label>
            <select v-model="reviewStatus" :class="selectClass">
              <option value="new">New</option>
              <option value="contacted">Contacted</option>
              <option value="shortlisted">Shortlisted</option>
              <option value="rejected">Rejected</option>
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
