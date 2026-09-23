<script setup lang="ts">
import { company } from '~/data/company'

usePageSeo({
  title: 'Contact',
  description: 'Talk to Limpar Global about your workforce needs, joining the talent pool, or organisational solutions.'
})

const intents = [
  {
    icon: 'briefcase',
    label: 'Workforce Needs',
    description: 'Access and manage high-quality African talent for your organisation.',
    to: '/for-employers#request',
    action: 'Request talent'
  },
  {
    icon: 'academic-cap',
    label: 'Join the Talent Pool',
    description: 'Develop your skills and access real workforce opportunities.',
    to: '/for-talent#apply',
    action: 'Apply now'
  },
  {
    icon: 'building',
    label: 'Organisational Solutions',
    description: 'HR strategy, organisational development and capacity building.',
    to: mailtoFor('Organisational Solutions'),
    action: 'Email us'
  },
  {
    icon: 'mail',
    label: 'General Enquiry',
    description: 'Anything else you’d like to ask us.',
    to: mailtoFor('General Enquiry'),
    action: 'Email us'
  }
]

function mailtoFor(subject: string) {
  return `mailto:${company.email}?subject=${encodeURIComponent(subject)}`
}
</script>

<template>
  <div>
    <PageHero
      eyebrow="Contact"
      title="Let's talk about what you need to grow"
      description="Choose what best describes why you're reaching out, and we'll get back to you."
    />

    <section class="bg-white">
      <div class="mx-auto max-w-8xl px-4 py-20 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
          <NuxtLink
            v-for="intent in intents"
            :key="intent.label"
            :to="intent.to"
            class="group flex flex-col gap-4 rounded-2xl border border-limpar-pale-border bg-white p-8 shadow-subtle transition-all duration-200 hover:-translate-y-1 hover:shadow-lifted"
          >
            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-limpar-deep text-white shadow-soft">
              <AppIcon :name="intent.icon" class="h-5 w-5" />
            </div>
            <h3 class="font-heading text-lg font-bold text-limpar-ink">{{ intent.label }}</h3>
            <p class="text-sm leading-relaxed text-limpar-slate">{{ intent.description }}</p>
            <span class="mt-auto flex items-center gap-1 text-sm font-bold text-limpar-deep">
              {{ intent.action }}
              <AppIcon name="arrow-right" class="h-4 w-4 transition-transform group-hover:translate-x-1" />
            </span>
          </NuxtLink>
        </div>

        <div class="mt-14 flex flex-col items-start gap-4 rounded-2xl border border-limpar-pale-border bg-limpar-pale p-8 shadow-subtle sm:flex-row sm:items-center sm:justify-between">
          <div class="flex flex-col gap-1.5">
            <span class="text-sm font-semibold uppercase tracking-wide text-limpar-slate/70">Email us directly</span>
            <a :href="`mailto:${company.email}`" class="font-heading text-xl font-bold text-limpar-deep">{{ company.email }}</a>
            <span class="text-sm text-limpar-slate">{{ company.location }}</span>
          </div>
          <a
            :href="company.linkedin"
            target="_blank"
            rel="noopener noreferrer"
            class="inline-flex items-center gap-2 rounded-lg border border-limpar-pale-border bg-white px-5 py-2.5 text-sm font-bold text-limpar-deep shadow-subtle transition-all hover:-translate-y-0.5 hover:bg-limpar-pale hover:shadow-card"
          >
            <AppIcon name="linkedin" class="h-4 w-4" />
            Connect on LinkedIn
          </a>
        </div>
      </div>
    </section>
  </div>
</template>
