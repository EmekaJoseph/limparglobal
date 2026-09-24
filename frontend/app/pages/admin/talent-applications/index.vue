<script setup lang="ts">
import { inputClass, selectClass } from '~/utils/formClasses'
import { normalizePage } from '~/utils/pagination'

definePageMeta({
  layout: 'admin',
  middleware: 'admin-auth'
})

useHead({ title: 'Talent Applications — Limpar Global Admin' })

interface TalentApplicationRow {
  id: number
  full_name: string
  email: string
  area_of_interest: string
  experience_range: string
  review_status: string
  created_at: string
}

const statusOptions = [
  { value: '', label: 'All statuses' },
  { value: 'new', label: 'New' },
  { value: 'contacted', label: 'Contacted' },
  { value: 'shortlisted', label: 'Shortlisted' },
  { value: 'rejected', label: 'Rejected' }
]

const search = ref('')
const status = ref('')
const page = ref(1)

const rows = ref<TalentApplicationRow[]>([])
const meta = ref({ currentPage: 1, lastPage: 1, total: 0 })
const loading = ref(true)
const loadError = ref(false)

let searchDebounce: ReturnType<typeof setTimeout> | undefined

async function load() {
  loading.value = true
  loadError.value = false
  try {
    const { data } = await useAdminApi().get('/admin/talent-applications', {
      params: {
        page: page.value,
        search: search.value || undefined,
        status: status.value || undefined
      }
    })
    const normalized = normalizePage<TalentApplicationRow>(data)
    rows.value = normalized.items
    meta.value = normalized
  } catch {
    loadError.value = true
  } finally {
    loading.value = false
  }
}

onMounted(load)
watch([status, page], load)
watch(search, () => {
  clearTimeout(searchDebounce)
  searchDebounce = setTimeout(() => {
    page.value = 1
    load()
  }, 350)
})

function formatDate(value: string) {
  return new Date(value).toLocaleDateString('en-GB', { day: 'numeric', month: 'short', year: 'numeric' })
}

function goToPage(newPage: number) {
  page.value = newPage
}
</script>

<template>
  <div>
    <div class="mb-5 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
      <div class="relative w-full sm:max-w-xs">
        <AppIcon name="search" class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-limpar-slate" />
        <input v-model="search" type="search" placeholder="Search name, email, interest…" :class="`${inputClass} pl-9`">
      </div>
      <select v-model="status" :class="`${selectClass} sm:w-52`">
        <option v-for="opt in statusOptions" :key="opt.value" :value="opt.value">{{ opt.label }}</option>
      </select>
    </div>

    <div class="overflow-hidden rounded-2xl border border-limpar-pale-border bg-white shadow-subtle">
      <div v-if="loading" class="flex items-center justify-center py-20 text-limpar-slate">
        <AppIcon name="spinner" class="h-5 w-5 animate-spin" />
      </div>

      <div v-else-if="loadError" class="px-5 py-16 text-center text-sm text-rose-700">
        Couldn't load applications. <button type="button" class="font-semibold underline" @click="load">Try again</button>
      </div>

      <AdminEmptyState v-else-if="!rows.length" icon="users" title="No applications found" description="Try adjusting your search or status filter." />

      <template v-else>
        <div class="overflow-x-auto">
          <table class="w-full min-w-[640px] text-left text-sm">
            <thead>
              <tr class="border-b border-limpar-pale-border text-xs font-semibold uppercase tracking-wide text-limpar-slate/70">
                <th class="px-5 py-3">Name</th>
                <th class="px-5 py-3">Area of interest</th>
                <th class="px-5 py-3">Experience</th>
                <th class="px-5 py-3">Status</th>
                <th class="px-5 py-3">Applied</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-limpar-pale-border">
              <tr
                v-for="row in rows"
                :key="row.id"
                class="cursor-pointer transition-colors hover:bg-limpar-pale/40"
                @click="navigateTo(`/admin/talent-applications/${row.id}`)"
              >
                <td class="px-5 py-3.5">
                  <p class="font-semibold text-limpar-ink">{{ row.full_name }}</p>
                  <p class="text-xs text-limpar-slate">{{ row.email }}</p>
                </td>
                <td class="px-5 py-3.5 text-limpar-ink">{{ row.area_of_interest }}</td>
                <td class="px-5 py-3.5 text-limpar-ink">{{ row.experience_range }}</td>
                <td class="px-5 py-3.5"><AdminStatusBadge :status="row.review_status" /></td>
                <td class="px-5 py-3.5 text-limpar-slate">{{ formatDate(row.created_at) }}</td>
              </tr>
            </tbody>
          </table>
        </div>

        <AdminPagination :current-page="meta.currentPage" :last-page="meta.lastPage" :total="meta.total" @change="goToPage" />
      </template>
    </div>
  </div>
</template>
