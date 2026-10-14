<script setup lang="ts">
interface Client {
  name: string
  logo?: string
  // True for logos supplied as a filled, self-contained lockup (their own
  // background colour baked in) rather than open line art — these stay at
  // full colour instead of the grayscale/fade treatment, which would
  // otherwise make light-on-dark marks unreadable once their background
  // is stripped away.
  boxed?: boolean
}

const clients: Client[] = [
  { name: 'Justice Watts', logo: '/images/clients/justice-watts.png' },
  { name: 'CargoExtra', logo: '/images/clients/cargoextra.png', boxed: true },
  { name: 'FLOW', logo: '/images/clients/flow.png' }
]
</script>

<template>
  <section class="bg-white">
    <div class="mx-auto max-w-8xl px-4 py-16 sm:px-6 lg:px-8">
      <div class="flex flex-col items-center gap-10 text-center">
        <div class="flex flex-col items-center gap-3">
          <span class="inline-flex items-center rounded-full bg-limpar-pale px-4 py-1.5 font-heading text-xs font-bold uppercase tracking-widest text-limpar-deep">Trusted By</span>
          <h2 class="font-heading text-2xl font-bold text-limpar-ink sm:text-3xl">Companies we already serve</h2>
        </div>
        <div class="flex flex-wrap items-center justify-center gap-x-16 gap-y-8">
          <div v-for="client in clients" :key="client.name" class="flex h-12 items-center justify-center sm:h-14">
            <img
              v-if="client.logo && client.boxed"
              :src="client.logo"
              :alt="client.name"
              class="h-full w-auto max-w-[180px] rounded-lg object-contain shadow-subtle transition-all duration-200 hover:-translate-y-0.5 hover:shadow-card"
            >
            <img
              v-else-if="client.logo"
              :src="client.logo"
              :alt="client.name"
              class="h-full w-auto max-w-[180px] object-contain grayscale opacity-70 transition-all duration-200 hover:grayscale-0 hover:opacity-100"
            >
            <span
              v-else
              class="font-heading text-xl font-bold tracking-tight text-limpar-slate transition-colors duration-200 hover:text-limpar-ink sm:text-2xl"
            >
              {{ client.name }}
            </span>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
