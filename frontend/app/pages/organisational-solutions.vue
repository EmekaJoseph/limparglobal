<script setup lang="ts">
import { orgServices } from '~/data/orgServices'
import { orgProcess } from '~/data/processes'
import { company } from '~/data/company'

usePageSeo({
  title: 'Organisational Solutions',
  description: 'HR strategy, organisational development, talent and performance management, and capacity building that help organisations scale sustainably.'
})
</script>

<template>
  <div>
    <PageHero
      eyebrow="Organisational Growth"
      title="Build the structures, people and systems to scale sustainably"
      description="We help growing organisations build the people systems and processes required to operate effectively — from HR strategy to organisational design and capacity building."
    >
      <NuxtLink
        :to="`mailto:${company.email}?subject=Organisational%20Solutions`"
        class="inline-flex items-center gap-2 rounded-lg bg-limpar-deep px-6 py-3.5 text-sm font-bold text-white shadow-soft transition-all hover:-translate-y-0.5 hover:bg-limpar-deep-dark hover:shadow-card"
      >
        Talk to Us About Your Organisation
      </NuxtLink>
    </PageHero>

    <section class="bg-white">
      <div class="mx-auto max-w-8xl px-4 py-20 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-3">
          <span class="font-heading text-sm font-bold uppercase tracking-widest text-limpar-deep">What We Offer</span>
          <h2 class="font-heading text-3xl font-bold text-limpar-ink sm:text-4xl">HR, organisational development and capacity building</h2>
        </div>
        <div class="mt-10">
          <ServiceList :items="orgServices" />
        </div>
      </div>
    </section>

    <section class="bg-limpar-pale">
      <div class="mx-auto max-w-8xl px-4 py-20 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-3">
          <span class="font-heading text-sm font-bold uppercase tracking-widest text-limpar-deep">Our Approach</span>
          <h2 class="font-heading text-3xl font-bold text-limpar-ink sm:text-4xl">From understanding to measurable results</h2>
          <p class="max-w-2xl text-base leading-relaxed text-limpar-slate">We start by understanding the organisation's actual challenge, identify the capability or structural gaps affecting performance, and develop practical solutions that can be implemented and measured.</p>
        </div>
        <div class="mt-12">
          <ProcessSteps :steps="orgProcess" />
        </div>
      </div>
    </section>

    <CtaBand
      title="Strengthening your foundations, or preparing to scale?"
      description="Let's talk about the capabilities your organisation needs to grow."
      primary-label="Talk to Us About Your Organisation"
      :primary-to="`mailto:${company.email}?subject=Organisational%20Solutions`"
    />
  </div>
</template>
