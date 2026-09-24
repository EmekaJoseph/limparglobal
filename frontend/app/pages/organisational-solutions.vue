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
        class="inline-flex items-center gap-3 rounded-full bg-limpar-deep py-2 pl-6 pr-2 text-sm font-bold text-white shadow-soft transition-all hover:-translate-y-0.5 hover:bg-limpar-deep-dark hover:shadow-card"
      >
        Talk to Us About Your Organisation
        <span class="flex h-8 w-8 items-center justify-center rounded-full bg-white/20">
          <AppIcon name="arrow-right" class="h-4 w-4" />
        </span>
      </NuxtLink>
    </PageHero>

    <section class="bg-white">
      <div class="mx-auto max-w-8xl px-4 py-20 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-3">
          <span class="inline-flex self-start items-center rounded-full bg-limpar-pale px-4 py-1.5 font-heading text-xs font-bold uppercase tracking-widest text-limpar-deep">What We Offer</span>
          <h2 class="font-heading text-3xl font-bold text-limpar-ink sm:text-4xl">HR, organisational development and capacity building</h2>
        </div>
        <div class="mt-10">
          <ServiceList :items="orgServices" />
        </div>
      </div>
    </section>

    <section class="bg-limpar-pale">
      <div class="mx-auto max-w-8xl px-4 py-20 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-12 lg:grid-cols-2 lg:items-center lg:gap-16">
          <div class="flex flex-col gap-3">
            <span class="inline-flex self-start items-center rounded-full bg-white px-4 py-1.5 font-heading text-xs font-bold uppercase tracking-widest text-limpar-deep">Our Approach</span>
            <h2 class="font-heading text-3xl font-bold text-limpar-ink sm:text-4xl">From understanding to measurable results</h2>
            <p class="max-w-2xl text-base leading-relaxed text-limpar-slate">We start by understanding the organisation's actual challenge, identify the capability or structural gaps affecting performance, and develop practical solutions that can be implemented and measured.</p>
          </div>
          <div class="order-first aspect-[4/3] w-full overflow-hidden rounded-3xl shadow-panel lg:order-last">
            <img
              src="/images/hero-team-wide.webp"
              alt="A Limpar Global team working through an organisational development plan together"
              class="h-full w-full object-cover object-top"
              width="1024"
              height="1024"
            >
          </div>
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
