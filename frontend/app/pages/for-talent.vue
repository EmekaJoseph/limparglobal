<script setup lang="ts">
import { talentProcess } from '~/data/processes'
import { pillars } from '~/data/pillars'

usePageSeo({
  title: 'For Talent',
  description: 'Join the Limpar talent ecosystem. Develop relevant, market-ready skills, get assessed and verified, and access real workforce opportunities.'
})

const talentDevelopmentPillar = pillars.find((pillar) => pillar.to === '/talent-development')
</script>

<template>
  <div>
    <PageHero
      eyebrow="Talent Development &amp; Opportunity"
      title="Build the skills to become work-ready and globally competitive"
      description="Join the Limpar talent ecosystem — develop relevant, market-ready skills, get assessed and verified, and access real workforce opportunities."
    >
      <NuxtLink
        to="#apply"
        class="inline-flex items-center gap-2 rounded-lg bg-limpar-deep px-6 py-3.5 text-sm font-bold text-white shadow-soft transition-all hover:-translate-y-0.5 hover:bg-limpar-deep-dark hover:shadow-card"
      >
        Join the Limpar Talent Pool
      </NuxtLink>
      <NuxtLink
        to="/talent-development"
        class="inline-flex items-center gap-2 rounded-lg border border-limpar-pale-border bg-white px-6 py-3.5 text-sm font-bold text-limpar-deep shadow-subtle transition-all hover:-translate-y-0.5 hover:shadow-card"
      >
        Explore Talent Development
      </NuxtLink>
    </PageHero>

    <section class="bg-white">
      <div class="mx-auto max-w-8xl px-4 py-20 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-3">
          <span class="font-heading text-sm font-bold uppercase tracking-widest text-limpar-deep">How It Works</span>
          <h2 class="font-heading text-3xl font-bold text-limpar-ink sm:text-4xl">From learning to real opportunity</h2>
        </div>
        <div class="mt-12">
          <ProcessSteps :steps="talentProcess" />
        </div>
      </div>
    </section>

    <section class="bg-limpar-pale">
      <div class="mx-auto max-w-8xl px-4 py-20 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-3xl rounded-3xl border border-limpar-pale-border bg-white p-10 text-center shadow-subtle">
          <p class="font-heading text-xl font-bold leading-snug text-limpar-ink sm:text-2xl">
            "We focus on developing talent around real workforce demand — not training for training's sake."
          </p>
        </div>
      </div>
    </section>

    <section v-if="talentDevelopmentPillar" class="bg-white">
      <div class="mx-auto max-w-8xl px-4 py-20 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-3">
          <span class="font-heading text-sm font-bold uppercase tracking-widest text-limpar-deep">Where to Start</span>
          <h2 class="font-heading text-3xl font-bold text-limpar-ink sm:text-4xl">Explore our talent academies and pathways</h2>
        </div>
        <NuxtLink
          :to="talentDevelopmentPillar.to"
          class="group mt-8 flex flex-col gap-4 rounded-2xl border border-limpar-pale-border bg-limpar-pale p-8 shadow-subtle transition-all duration-200 hover:-translate-y-1 hover:shadow-lifted sm:max-w-md"
        >
          <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-limpar-deep text-white shadow-soft">
            <AppIcon :name="talentDevelopmentPillar.icon" class="h-5 w-5" />
          </div>
          <h3 class="font-heading text-xl font-bold text-limpar-ink">{{ talentDevelopmentPillar.title }}</h3>
          <p class="text-sm leading-relaxed text-limpar-slate">{{ talentDevelopmentPillar.description }}</p>
          <span class="mt-auto flex items-center gap-1 text-sm font-bold text-limpar-deep">
            View academies &amp; pathways
            <AppIcon name="arrow-right" class="h-4 w-4 transition-transform group-hover:translate-x-1" />
          </span>
        </NuxtLink>
      </div>
    </section>

    <section class="bg-white">
      <div class="mx-auto max-w-4xl px-4 py-20 sm:px-6 lg:px-8">
        <div class="mb-14 flex flex-col gap-3 text-center">
          <span class="font-heading text-sm font-bold uppercase tracking-widest text-limpar-deep">Join the Talent Pool</span>
          <h2 class="font-heading text-3xl font-bold text-limpar-ink sm:text-4xl">Talent Application Form</h2>
          <p class="text-base leading-relaxed text-limpar-slate">Build your skills. Prove your capability. Access better opportunities. Complete this form to join the Limpar Talent Pool.</p>
        </div>
        <TalentApplicationForm />
      </div>
    </section>
  </div>
</template>
