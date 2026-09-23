<script setup lang="ts">
import { company } from '~/data/company'
</script>

<template>
  <section class="bg-white">
    <div class="mx-auto max-w-8xl px-4 pb-16 pt-14 sm:px-6 lg:px-8">
      <div class="flex flex-col items-center gap-14 lg:flex-row">
        <div class="flex flex-1 flex-col gap-6">
          <span class="font-heading text-sm font-bold uppercase tracking-widest text-limpar-deep">African Workforce
            &amp; Talent Partner</span>
          <h1 class="font-heading text-5xl font-extrabold leading-[1.1] text-limpar-ink sm:text-6xl">Building Africa's
            workforce for global opportunity</h1>
          <p class="max-w-xl text-lg leading-relaxed text-limpar-slate">{{ company.positioning }}</p>
          <div class="flex flex-wrap gap-4 pt-2">
            <NuxtLink to="/contact"
              class="inline-flex items-center gap-2 rounded-lg bg-limpar-deep px-6 py-3.5 text-sm font-bold text-white shadow-soft transition-all hover:-translate-y-0.5 hover:bg-limpar-deep-dark hover:shadow-card">
              Talk to Us About Your Workforce Needs
            </NuxtLink>
            <NuxtLink to="/for-talent#apply"
              class="inline-flex items-center gap-2 rounded-lg border border-limpar-pale-border px-6 py-3.5 text-sm font-bold text-limpar-deep shadow-subtle transition-all hover:-translate-y-0.5 hover:bg-limpar-pale hover:shadow-card">
              Join the Talent Pool
            </NuxtLink>
          </div>
          <div
            class="flex flex-wrap gap-x-5 gap-y-2 pt-3 text-xs font-semibold uppercase tracking-wide text-limpar-slate/70">
            <span>Workforce Solutions</span>
            <span>Talent Development</span>
            <span>Organisational Growth</span>
          </div>
        </div>
        <div class="w-full flex-1">
          <div class="aspect-[4/5] w-full overflow-hidden rounded-3xl shadow-panel">
            <img src="/images/hero-team-wide.webp" alt="A Limpar Global talent team collaborating in a modern office"
              class="h-full w-full object-cover object-[center_28%]" width="1024" height="1024">
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
