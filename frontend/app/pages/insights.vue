<script setup lang="ts">
import { insights } from '~/data/insights'
import { company } from '~/data/company'

usePageSeo({
  title: 'Insights',
  description: 'Ideas, updates and thought leadership from the Limpar Global team on African workforce, talent development and organisational growth.'
})
</script>

<template>
  <div>
    <PageHero
      eyebrow="Insights"
      title="Ideas and updates from Limpar Global"
      description="Thought leadership on African workforce development, talent readiness and organisational growth — shared as we publish."
    />

    <section class="bg-white">
      <div class="mx-auto max-w-8xl px-4 py-20 sm:px-6 lg:px-8">
        <div v-if="insights.length" class="grid grid-cols-1 gap-6 md:grid-cols-3">
          <a
            v-for="post in insights"
            :key="post.url"
            :href="post.url"
            target="_blank"
            rel="noopener noreferrer"
            class="flex flex-col gap-3 rounded-2xl border border-limpar-pale-border bg-white p-7 shadow-subtle transition-all duration-200 hover:-translate-y-1 hover:shadow-lifted"
          >
            <span class="text-xs font-semibold uppercase tracking-wide text-limpar-slate/70">{{ post.date }}</span>
            <h3 class="font-heading text-lg font-bold text-limpar-ink">{{ post.title }}</h3>
            <p class="text-sm leading-relaxed text-limpar-slate">{{ post.excerpt }}</p>
            <span class="mt-auto flex items-center gap-1 text-sm font-bold text-limpar-deep">
              Read on LinkedIn
              <AppIcon name="arrow-right" class="h-4 w-4" />
            </span>
          </a>
        </div>

        <div v-else class="mx-auto flex max-w-xl flex-col items-center gap-5 rounded-3xl border border-limpar-pale-border bg-limpar-pale px-8 py-16 text-center shadow-subtle">
          <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-limpar-deep text-white shadow-soft">
            <AppIcon name="linkedin" class="h-5 w-5" />
          </div>
          <h2 class="font-heading text-xl font-bold text-limpar-ink">New articles are on the way</h2>
          <p class="text-sm leading-relaxed text-limpar-slate">We're preparing our first pieces on African workforce trends, talent development and organisational growth. Follow us on LinkedIn to see them as soon as they're published.</p>
          <a
            :href="company.linkedin"
            target="_blank"
            rel="noopener noreferrer"
            class="inline-flex items-center gap-2 rounded-lg bg-limpar-deep px-6 py-3 text-sm font-bold text-white shadow-soft transition-all hover:-translate-y-0.5 hover:bg-limpar-deep-dark hover:shadow-card"
          >
            Follow Limpar Global on LinkedIn
          </a>
        </div>
      </div>
    </section>
  </div>
</template>
