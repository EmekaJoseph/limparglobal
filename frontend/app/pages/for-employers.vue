<script setup lang="ts">
import { employerProcess } from '~/data/processes'
import { employerServices } from '~/data/orgServices'
import { company } from '~/data/company'

usePageSeo({
  title: 'For Employers',
  description: 'Access and manage high-quality African talent. Limpar Global helps organisations define workforce needs, source, assess, develop, verify, place and manage talent.'
})
</script>

<template>
  <div>
    <PageHero
      eyebrow="Workforce Solutions"
      title="Access and manage high-quality African talent"
      description="From defining your workforce need to placing and managing verified talent — we help organisations build reliable, capable teams across Africa."
    >
      <NuxtLink
        to="#request"
        class="inline-flex items-center gap-2 rounded-lg bg-limpar-deep px-6 py-3.5 text-sm font-bold text-white shadow-soft transition-all hover:-translate-y-0.5 hover:bg-limpar-deep-dark hover:shadow-card"
      >
        Request Talent
      </NuxtLink>
      <NuxtLink
        :to="`mailto:${company.email}?subject=Workforce%20Needs`"
        class="inline-flex items-center gap-2 rounded-lg border border-limpar-pale-border bg-white px-6 py-3.5 text-sm font-bold text-limpar-deep shadow-subtle transition-all hover:-translate-y-0.5 hover:shadow-card"
      >
        Talk to Us Directly
      </NuxtLink>
    </PageHero>

    <section class="bg-white">
      <div class="mx-auto max-w-8xl px-4 py-20 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-3">
          <span class="font-heading text-sm font-bold uppercase tracking-widest text-limpar-deep">How It Works</span>
          <h2 class="font-heading text-3xl font-bold text-limpar-ink sm:text-4xl">A clear path from workforce need to managed talent</h2>
        </div>
        <div class="mt-12">
          <ProcessSteps :steps="employerProcess" />
        </div>
      </div>
    </section>

    <section class="bg-limpar-pale">
      <div class="mx-auto max-w-8xl px-4 py-20 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-3">
          <span class="font-heading text-sm font-bold uppercase tracking-widest text-limpar-deep">What We Offer</span>
          <h2 class="font-heading text-3xl font-bold text-limpar-ink sm:text-4xl">Workforce solutions built around your needs</h2>
        </div>
        <div class="mt-10">
          <ServiceList :items="employerServices" />
        </div>
        <p class="mt-8 max-w-2xl text-sm leading-relaxed text-limpar-slate">
          We also provide global talent support for organisations seeking to build teams in Africa — helping reduce the operational complexity that can come with building and managing distributed teams.
        </p>
      </div>
    </section>

    <section class="bg-white">
      <div class="mx-auto max-w-4xl px-4 py-20 sm:px-6 lg:px-8">
        <div class="mb-14 flex flex-col gap-3 text-center">
          <span class="font-heading text-sm font-bold uppercase tracking-widest text-limpar-deep">Request Talent</span>
          <h2 class="font-heading text-3xl font-bold text-limpar-ink sm:text-4xl">Employer Talent &amp; Workforce Request</h2>
          <p class="text-base leading-relaxed text-limpar-slate">Tell us the talent you need. We'll help you build the pipeline — complete this short form and a member of our team will contact you to discuss your requirement.</p>
        </div>
        <EmployerRequestForm />
      </div>
    </section>
  </div>
</template>
