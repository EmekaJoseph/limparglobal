<script setup lang="ts">
import { normalizePage } from '~/utils/pagination'

definePageMeta({
  layout: 'admin',
  middleware: 'admin-auth'
})

useHead({ title: 'Visitors — Limpar Global Admin' })

interface VisitorRow {
  ip_address: string
  visit_count: number
  first_seen: string
  last_seen: string
  last_path: string | null
  last_referrer: string | null
  last_user_agent: string | null
}

const page = ref(1)
const rows = ref<VisitorRow[]>([])
const meta = ref({ currentPage: 1, lastPage: 1, total: 0 })
const loading = ref(true)
const loadError = ref(false)

async function load() {
  loading.value = true
  loadError.value = false
  try {
    const { data } = await useAdminApi().get('/admin/visitors', { params: { page: page.value } })
    const normalized = normalizePage<VisitorRow>(data)
    rows.value = normalized.items
    meta.value = normalized
  } catch {
    loadError.value = true
  } finally {
    loading.value = false
  }
}

onMounted(load)
watch(page, load)

function formatDate(value: string) {
  return new Date(value).toLocaleString('en-GB', { day: 'numeric', month: 'short', hour: '2-digit', minute: '2-digit' })
}

function goToPage(newPage: number) {
  page.value = newPage
}
</script>

<template>
  <div>
    <p class="mb-5 text-sm text-limpar-slate">Visits are grouped by IP address, showing how often each visitor has returned.</p>

    <div class="overflow-hidden rounded-2xl border border-limpar-pale-border bg-white shadow-subtle">
      <div v-if="loading" class="flex items-center justify-center py-20 text-limpar-slate">
        <AppIcon name="spinner" class="h-5 w-5 animate-spin" />
      </div>

      <div v-else-if="loadError" class="px-5 py-16 text-center text-sm text-rose-700">
        Couldn't load visitors. <button type="button" class="font-semibold underline" @click="load">Try again</button>
      </div>

      <AdminEmptyState v-else-if="!rows.length" icon="globe" title="No visits recorded yet" description="Visits will appear here once the frontend starts reporting page views." />

      <template v-else>
        <div class="overflow-x-auto">
          <table class="w-full min-w-[680px] text-left text-sm">
            <thead>
              <tr class="border-b border-limpar-pale-border text-xs font-semibold uppercase tracking-wide text-limpar-slate/70">
                <th class="px-5 py-3">IP address</th>
                <th class="px-5 py-3">Visits</th>
                <th class="px-5 py-3">First seen</th>
                <th class="px-5 py-3">Last seen</th>
                <th class="px-5 py-3">Last page</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-limpar-pale-border">
              <tr v-for="row in rows" :key="row.ip_address">
                <td class="px-5 py-3.5">
                  <div class="flex items-center gap-2 font-medium text-limpar-ink">
                    <AppIcon name="map-pin" class="h-4 w-4 text-limpar-slate" />
                    {{ row.ip_address }}
                  </div>
                </td>
                <td class="px-5 py-3.5">
                  <span class="rounded-full bg-limpar-pale px-2.5 py-1 text-xs font-semibold text-limpar-deep">{{ row.visit_count }}</span>
                </td>
                <td class="px-5 py-3.5 text-limpar-slate">{{ formatDate(row.first_seen) }}</td>
                <td class="px-5 py-3.5 text-limpar-slate">{{ formatDate(row.last_seen) }}</td>
                <td class="max-w-[220px] truncate px-5 py-3.5 text-limpar-ink" :title="row.last_user_agent ?? undefined">{{ row.last_path ?? '—' }}</td>
              </tr>
            </tbody>
          </table>
        </div>

        <AdminPagination :current-page="meta.currentPage" :last-page="meta.lastPage" :total="meta.total" @change="goToPage" />
      </template>
    </div>
  </div>
</template>
