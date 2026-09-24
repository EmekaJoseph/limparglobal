<script setup lang="ts">
const company = useCompanySettings()
</script>

<template>
  <section class="relative overflow-hidden bg-white">
    <div class="mx-auto max-w-5xl px-4 pb-20 pt-16 text-center sm:px-6 lg:px-8">
      <span class="inline-flex self-start items-center rounded-full bg-limpar-pale px-4 py-1.5 font-heading text-xs font-bold uppercase tracking-widest text-limpar-deep">African Workforce &amp; Talent Partner</span>

      <div class="relative mt-6">
        <div class="absolute -left-6 top-1/2 hidden -translate-y-1/2 flex-col gap-2.5 lg:flex xl:-left-16">
          <div class="h-1.5 w-14 -rotate-6 rounded-full bg-limpar-sky/50" />
          <div class="h-1.5 w-24 -rotate-6 rounded-full bg-limpar-sky" />
          <div class="h-1.5 w-20 -rotate-6 rounded-full bg-limpar-deep" />
        </div>
        <div class="absolute -right-6 top-1/2 hidden -translate-y-1/2 flex-col items-end gap-2.5 lg:flex xl:-right-16">
          <div class="h-1.5 w-20 rotate-6 rounded-full bg-limpar-deep" />
          <div class="h-1.5 w-24 rotate-6 rounded-full bg-limpar-sky" />
          <div class="h-1.5 w-14 rotate-6 rounded-full bg-limpar-sky/50" />
        </div>

        <h1 class="font-heading text-5xl font-extrabold leading-[1.15] text-limpar-ink sm:text-6xl lg:text-7xl">
          Building Africa's
          <span class="inline-block rounded-lg bg-limpar-sky-light px-3 py-0.5 text-limpar-deep-dark">workforce</span>
          for global opportunity
        </h1>
      </div>

      <p class="mx-auto mt-8 max-w-2xl text-lg leading-relaxed text-limpar-slate">{{ company.positioning }}</p>

      <div class="mt-10 flex flex-wrap items-center justify-center gap-4">
        <NuxtLink
          to="/contact"
          class="inline-flex items-center gap-3 rounded-full bg-limpar-deep py-2 pl-6 pr-2 text-sm font-bold text-white shadow-soft transition-all hover:-translate-y-0.5 hover:bg-limpar-deep-dark hover:shadow-card"
        >
          Talk to Us About Your Workforce Needs
          <span class="flex h-8 w-8 items-center justify-center rounded-full bg-white/20">
            <AppIcon name="arrow-right" class="h-4 w-4" />
          </span>
        </NuxtLink>
        <NuxtLink
          to="/for-talent#apply"
          class="inline-flex items-center gap-3 rounded-full border border-limpar-pale-border bg-white py-2 pl-6 pr-2 text-sm font-bold text-limpar-deep shadow-subtle transition-all hover:-translate-y-0.5 hover:bg-limpar-pale hover:shadow-card"
        >
          Join the Talent Pool
          <span class="flex h-8 w-8 items-center justify-center rounded-full bg-limpar-pale">
            <AppIcon name="arrow-right" class="h-4 w-4" />
          </span>
        </NuxtLink>
      </div>

      <div class="mt-16 flex flex-col items-center gap-4">
        <span class="font-heading text-xs font-bold uppercase tracking-widest text-limpar-slate/60">What we do</span>
        <div class="flex flex-wrap items-center justify-center gap-3">
          <span class="rounded-full border border-limpar-pale-border bg-limpar-pale px-4 py-1.5 text-xs font-semibold uppercase tracking-wide text-limpar-deep">Workforce Solutions</span>
          <span class="rounded-full border border-limpar-pale-border bg-limpar-pale px-4 py-1.5 text-xs font-semibold uppercase tracking-wide text-limpar-deep">Talent Development</span>
          <span class="rounded-full border border-limpar-pale-border bg-limpar-pale px-4 py-1.5 text-xs font-semibold uppercase tracking-wide text-limpar-deep">Organisational Growth</span>
        </div>
      </div>
    </div>
  </section>
</template>
