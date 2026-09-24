<script setup lang="ts">
definePageMeta({
  layout: 'admin',
  middleware: 'admin-auth'
})

useHead({ title: 'Dashboard — Limpar Global Admin' })

interface DashboardData {
  talent_applications: { total: number; new: number; this_week: number }
  employer_requests: { total: number; new: number; this_week: number }
  visitors: { total_visits: number; unique_ips: number; visits_today: number; visits_this_week: number }
  recent_talent_applications: Array<{ id: number; full_name: string; area_of_interest: string; review_status: string; created_at: string }>
  recent_employer_requests: Array<{ id: number; organisation_name: string; roles: string; review_status: string; created_at: string }>
}

const data = ref<DashboardData | null>(null)
const loading = ref(true)
const loadError = ref(false)

async function load() {
  loading.value = true
  loadError.value = false
  try {
    const { data: res } = await useAdminApi().get<DashboardData>('/admin/dashboard')
    data.value = res
  } catch {
    loadError.value = true
  } finally {
    loading.value = false
  }
}

onMounted(load)

function formatDate(value: string) {
  return new Date(value).toLocaleDateString('en-GB', { day: 'numeric', month: 'short', year: 'numeric' })
}
</script>

<template>
  <div>
    <div v-if="loading" class="flex items-center justify-center py-24 text-limpar-slate">
      <AppIcon name="spinner" class="h-5 w-5 animate-spin" />
    </div>

    <div v-else-if="loadError" class="rounded-2xl border border-rose-200 bg-rose-50 px-5 py-8 text-center text-sm text-rose-700">
      Couldn't load the dashboard. <button type="button" class="font-semibold underline" @click="load">Try again</button>
    </div>

    <div v-else-if="data" class="space-y-8">
      <div class="grid grid-cols-2 gap-4 lg:grid-cols-4">
        <AdminStatCard label="Talent applications" :value="data.talent_applications.total" icon="users" :hint="`${data.talent_applications.new} new`" />
        <AdminStatCard label="Employer requests" :value="data.employer_requests.total" icon="briefcase" :hint="`${data.employer_requests.new} new`" />
        <AdminStatCard label="Unique visitors" :value="data.visitors.unique_ips" icon="globe" :hint="`${data.visitors.visits_today} visits today`" />
        <AdminStatCard label="Visits this week" :value="data.visitors.visits_this_week" icon="trending-up" />
      </div>

      <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
        <div class="rounded-2xl border border-limpar-pale-border bg-white shadow-subtle">
          <div class="flex items-center justify-between border-b border-limpar-pale-border px-5 py-4">
            <p class="font-heading text-sm font-bold text-limpar-ink">Recent talent applications</p>
            <NuxtLink to="/admin/talent-applications" class="text-xs font-semibold text-limpar-deep hover:underline">View all</NuxtLink>
          </div>
          <AdminEmptyState v-if="!data.recent_talent_applications.length" icon="users" title="No applications yet" />
          <ul v-else class="divide-y divide-limpar-pale-border">
            <li v-for="item in data.recent_talent_applications" :key="item.id">
              <NuxtLink :to="`/admin/talent-applications/${item.id}`" class="flex items-center justify-between gap-3 px-5 py-3.5 transition-colors hover:bg-limpar-pale/40">
                <div class="min-w-0">
                  <p class="truncate text-sm font-semibold text-limpar-ink">{{ item.full_name }}</p>
                  <p class="truncate text-xs text-limpar-slate">{{ item.area_of_interest }} &middot; {{ formatDate(item.created_at) }}</p>
                </div>
                <AdminStatusBadge :status="item.review_status" />
              </NuxtLink>
            </li>
          </ul>
        </div>

        <div class="rounded-2xl border border-limpar-pale-border bg-white shadow-subtle">
          <div class="flex items-center justify-between border-b border-limpar-pale-border px-5 py-4">
            <p class="font-heading text-sm font-bold text-limpar-ink">Recent employer requests</p>
            <NuxtLink to="/admin/employer-requests" class="text-xs font-semibold text-limpar-deep hover:underline">View all</NuxtLink>
          </div>
          <AdminEmptyState v-if="!data.recent_employer_requests.length" icon="briefcase" title="No requests yet" />
          <ul v-else class="divide-y divide-limpar-pale-border">
            <li v-for="item in data.recent_employer_requests" :key="item.id">
              <NuxtLink :to="`/admin/employer-requests/${item.id}`" class="flex items-center justify-between gap-3 px-5 py-3.5 transition-colors hover:bg-limpar-pale/40">
                <div class="min-w-0">
                  <p class="truncate text-sm font-semibold text-limpar-ink">{{ item.organisation_name }}</p>
                  <p class="truncate text-xs text-limpar-slate">{{ item.roles }} &middot; {{ formatDate(item.created_at) }}</p>
                </div>
                <AdminStatusBadge :status="item.review_status" />
              </NuxtLink>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>
