<script setup lang="ts">
import { platformPipeline } from '~/data/processes'
import { company } from '~/data/company'

usePageSeo({
  title: 'About Limpar',
  description: 'Limpar Global is a consulting and workforce solutions firm helping organisations build the people, capabilities, systems and operational foundations they need to grow.'
})

const focusAreas = [
  'HR & Organisational Development',
  'Talent Acquisition & Workforce Solutions',
  'Learning & Capacity Development',
  'Project & Business Operations',
  'Strategic Business Support'
]
</script>

<template>
  <div>
    <PageHero
      eyebrow="About Limpar"
      title="Building stronger organisations. Developing better talent. Enabling sustainable growth."
      description="Limpar Global is a consulting and workforce solutions firm helping organisations build the people, capabilities, systems and operational foundations they need to grow."
    >
      <template #visual>
        <div class="aspect-[4/5] w-full max-w-xs shrink-0 overflow-hidden rounded-3xl shadow-panel sm:max-w-sm lg:w-80">
          <img
            src="/images/about-hero.webp"
            alt="Two Limpar Global colleagues reviewing workforce data together"
            class="h-full w-full object-cover"
            width="1100"
            height="1100"
          >
        </div>
      </template>
    </PageHero>

    <section class="bg-white">
      <div class="mx-auto max-w-4xl px-4 py-20 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-3">
          <span class="inline-flex self-start items-center rounded-full bg-limpar-pale px-4 py-1.5 font-heading text-xs font-bold uppercase tracking-widest text-limpar-deep">Who We Are</span>
          <h2 class="font-heading text-3xl font-bold text-limpar-ink sm:text-4xl">Where people, organisations and growth meet</h2>
        </div>
        <p class="mt-6 text-lg leading-relaxed text-limpar-slate">We work at the intersection of people, organisations and growth — combining human capital expertise, organisational development, talent solutions and practical business support to help organisations solve challenges and move from strategy to execution.</p>
        <div class="mt-6 flex flex-wrap gap-x-5 gap-y-2 text-xs font-semibold uppercase tracking-wide text-limpar-slate/70">
          <span v-for="area in focusAreas" :key="area">{{ area }}</span>
        </div>
        <p class="mt-6 text-lg leading-relaxed text-limpar-slate">As organisations and the world of work continue to change, we are expanding this work through a new focus on African talent development and workforce delivery — helping organisations access capable African professionals while helping talent build the practical skills required to succeed in today's and tomorrow's workplace.</p>
      </div>
    </section>

    <section class="bg-limpar-pale">
      <div class="mx-auto max-w-8xl px-4 py-20 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-12 lg:grid-cols-2 lg:items-center lg:gap-16">
          <div class="aspect-[4/5] w-full overflow-hidden rounded-3xl shadow-panel">
            <img
              src="/images/hero-team.webp"
              alt="Two Limpar Global talent professionals reviewing a workforce plan together"
              class="h-full w-full object-cover object-[center_28%]"
              width="1000"
              height="1506"
            >
          </div>
          <div class="flex flex-col gap-5">
            <div class="flex flex-col gap-3">
              <span class="inline-flex self-start items-center rounded-full bg-white px-4 py-1.5 font-heading text-xs font-bold uppercase tracking-widest text-limpar-deep">Our Perspective</span>
              <h2 class="font-heading text-3xl font-bold text-limpar-ink sm:text-4xl">On African talent</h2>
            </div>
            <div class="flex flex-col gap-5 text-base leading-relaxed text-limpar-slate">
              <p>Africa has a growing and increasingly diverse workforce with significant potential to participate in local and global value chains. But access to talent and access to opportunity do not always meet.</p>
              <p>Organisations can struggle to find people with the right combination of technical capability, practical experience, professional skills and workplace readiness. At the same time, many capable African professionals need clearer pathways from learning to meaningful work.</p>
              <p class="font-heading text-lg font-bold text-limpar-ink">Limpar is building at that intersection — helping organisations access capable talent while helping African professionals become more prepared, visible and competitive in a changing global workforce.</p>
              <p>This is not about training people for training's sake. It is about developing talent around real workforce demand.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="bg-white">
      <div class="mx-auto max-w-8xl px-4 py-20 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-3">
          <span class="inline-flex self-start items-center rounded-full bg-limpar-pale px-4 py-1.5 font-heading text-xs font-bold uppercase tracking-widest text-limpar-deep">Our Work Today, Our Direction Tomorrow</span>
          <h2 class="font-heading text-3xl font-bold text-limpar-ink sm:text-4xl">A more connected approach to talent</h2>
          <p class="max-w-2xl text-base leading-relaxed text-limpar-slate">Limpar Global continues to work with organisations on immediate, practical business needs — from recruitment and HR systems to organisational development, capacity building, project support and workforce management. At the same time, we're building a broader workforce platform that connects:</p>
        </div>
        <div class="mt-12">
          <ProcessSteps :steps="platformPipeline" />
        </div>
        <p class="mt-10 max-w-2xl text-base leading-relaxed text-limpar-slate">This creates a more connected approach to talent — one that benefits both organisations and professionals.</p>
      </div>
    </section>

    <section class="bg-limpar-deep">
      <div class="mx-auto max-w-4xl px-4 py-24 text-center sm:px-6 lg:px-8">
        <span class="inline-flex self-start items-center rounded-full bg-white/10 px-4 py-1.5 font-heading text-xs font-bold uppercase tracking-widest text-limpar-sky-light">Our Vision</span>
        <p class="mt-5 font-heading text-2xl font-bold leading-snug text-white sm:text-3xl">
          To become a trusted African partner for workforce development, talent delivery and organisational growth — connecting capable people with organisations and opportunities that enable them to thrive.
        </p>
        <p class="mt-8 text-lg font-semibold text-white/80">{{ company.tagline }}</p>
      </div>
    </section>

    <CtaBand
      title="Let's build what you need to grow"
      description="We help organisations build what they need to grow, and help talent become ready for the opportunities ahead."
      primary-label="Talk to Us"
      :primary-to="`mailto:${company.email}`"
      secondary-label="Join the Talent Pool"
      secondary-to="/for-talent#apply"
    />
  </div>
</template>
