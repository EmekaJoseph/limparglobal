<script setup lang="ts">
const company = useCompanySettings()
</script>

<template>
  <section class="bg-white">
    <div class="mx-auto max-w-8xl px-4 pb-16 pt-14 sm:px-6 lg:px-8">
      <div class="flex flex-col items-center gap-14 lg:flex-row">
        <div class="flex flex-1 flex-col gap-6">
          <span
            class="inline-flex self-start items-center rounded-full bg-limpar-pale px-4 py-1.5 font-heading text-xs font-bold uppercase tracking-widest text-limpar-deep">African
            Workforce
            &amp; Talent Partner</span>
          <h1 class="font-heading text-5xl font-extrabold leading-[1.1] text-limpar-ink sm:text-6xl">Building Africa's
            workforce for global opportunity</h1>
          <p class="max-w-xl text-lg leading-relaxed text-limpar-slate">{{ company.positioning }}</p>
          <div class="flex flex-wrap gap-4 pt-2">
            <NuxtLink to="/contact"
              class="inline-flex items-center gap-3 rounded-full bg-limpar-deep py-2 pl-6 pr-2 text-sm font-bold text-white shadow-soft transition-all hover:-translate-y-0.5 hover:bg-limpar-deep-dark hover:shadow-card">
              Talk to Us About Your Workforce Needs
              <span class="flex h-8 w-8 items-center justify-center rounded-full bg-white/20">
                <AppIcon name="arrow-right" class="h-4 w-4" />
              </span>
            </NuxtLink>
            <NuxtLink to="/for-talent#apply"
              class="inline-flex items-center gap-3 rounded-full border border-limpar-pale-border py-2 pl-6 pr-2 text-sm font-bold text-limpar-deep shadow-subtle transition-all hover:-translate-y-0.5 hover:bg-limpar-pale hover:shadow-card">
              Join the Talent Pool
              <span class="flex h-8 w-8 items-center justify-center rounded-full bg-limpar-pale">
                <AppIcon name="arrow-right" class="h-4 w-4" />
              </span>
            </NuxtLink>
          </div>
          <div
            class="flex flex-wrap gap-x-5 gap-y-2 pt-3 text-xs font-semibold uppercase tracking-wide text-limpar-slate/70">
            <span>Workforce Solutions</span>
            <span>Talent Development</span>
            <span>Organisational Growth</span>
          </div>
        </div>
        <div class="relative w-full flex-1">
          <div class="aspect-[4/3] w-full overflow-hidden rounded-3xl shadow-panel">
            <img src="/images/hero-team-wide.webp" alt="A Limpar Global talent team collaborating in a modern office"
              class="h-full w-full object-cover object-top" width="1024" height="1024">
          </div>
          <div
            class="absolute -bottom-6 -left-6 hidden max-w-[13rem] flex-col gap-1 rounded-2xl bg-white p-5 shadow-card ring-1 ring-limpar-pale-border sm:flex">
            <span class="font-heading text-sm font-bold text-limpar-ink">{{ company.tagline }}</span>
            <span class="text-xs text-limpar-slate">{{ company.location }}</span>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
