<script setup lang="ts">
import { academies, pathways } from '~/data/academies'
import { talentProcess } from '~/data/processes'

usePageSeo({
  title: 'Talent Development',
  description: 'Employer-led academies and specialised workforce pathways that build job-ready skills aligned to real workforce demand.'
})
</script>

<template>
  <div>
    <PageHero
      eyebrow="Talent Development"
      title="Employer-led learning, built around real workforce demand"
      description="We're building a talent development ecosystem that bridges the gap between learning and employment — practical learning, competency development, assessment, professional readiness and connection to real opportunities."
    >
      <NuxtLink
        to="/for-talent#apply"
        class="inline-flex items-center gap-2 rounded-lg bg-limpar-deep px-6 py-3.5 text-sm font-bold text-white shadow-soft transition-all hover:-translate-y-0.5 hover:bg-limpar-deep-dark hover:shadow-card"
      >
        Join the Limpar Talent Pool
      </NuxtLink>
    </PageHero>

    <section class="bg-white">
      <div class="mx-auto max-w-8xl px-4 py-20 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-3">
          <span class="font-heading text-sm font-bold uppercase tracking-widest text-limpar-deep">Core Talent Academies</span>
          <h2 class="font-heading text-3xl font-bold text-limpar-ink sm:text-4xl">Structured, employer-led learning pathways</h2>
        </div>
        <div class="mt-10 grid grid-cols-1 gap-6 md:grid-cols-2">
          <div
            v-for="academy in academies"
            :key="academy.title"
            class="flex flex-col gap-3 rounded-2xl border border-limpar-pale-border bg-white p-7 shadow-subtle transition-shadow duration-200 hover:shadow-card"
          >
            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-limpar-deep text-white shadow-soft">
              <AppIcon :name="academy.icon" class="h-5 w-5" />
            </div>
            <h3 class="font-heading text-lg font-bold text-limpar-ink">{{ academy.title }}</h3>
            <p class="text-sm leading-relaxed text-limpar-slate">{{ academy.description }}</p>
          </div>
        </div>
      </div>
    </section>

    <section class="bg-limpar-pale">
      <div class="mx-auto max-w-8xl px-4 py-20 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-3">
          <span class="font-heading text-sm font-bold uppercase tracking-widest text-limpar-deep">Specialised Workforce Pathways</span>
          <h2 class="font-heading text-3xl font-bold text-limpar-ink sm:text-4xl">Alongside our core academies</h2>
        </div>
        <div class="mt-10 grid grid-cols-1 gap-6 sm:grid-cols-3">
          <div
            v-for="pathway in pathways"
            :key="pathway.title"
            class="flex flex-col gap-3 rounded-2xl border border-limpar-pale-border bg-white p-6 shadow-subtle transition-shadow duration-200 hover:shadow-card"
          >
            <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-limpar-pale text-limpar-deep">
              <AppIcon :name="pathway.icon" class="h-4 w-4" />
            </div>
            <h3 class="font-heading text-base font-bold text-limpar-ink">{{ pathway.title }}</h3>
            <p class="text-sm leading-relaxed text-limpar-slate">{{ pathway.description }}</p>
          </div>
        </div>
      </div>
    </section>

    <section class="bg-white">
      <div class="mx-auto max-w-8xl px-4 py-20 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-3">
          <span class="font-heading text-sm font-bold uppercase tracking-widest text-limpar-deep">Our Approach</span>
          <h2 class="font-heading text-3xl font-bold text-limpar-ink sm:text-4xl">Beyond course completion</h2>
          <p class="max-w-2xl text-base leading-relaxed text-limpar-slate">We focus on practical learning, competency development, assessment, professional readiness and connection to real workforce opportunities.</p>
        </div>
        <div class="mt-12">
          <ProcessSteps :steps="talentProcess" />
        </div>
      </div>
    </section>

    <CtaBand
      title="Build the capabilities organisations actually need"
      description="Join the Limpar talent ecosystem and start your learning pathway."
      primary-label="Join the Limpar Talent Pool"
      primary-to="/for-talent#apply"
    />
  </div>
</template>
