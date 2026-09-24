<script setup lang="ts">
import { insights } from '~/data/insights'
import { insightCategories } from '~/data/insightCategories'
import { company } from '~/data/company'

usePageSeo({
  title: 'Insights',
  description: 'Thought leadership and market intelligence on African workforce development, talent readiness and organisational growth from the Limpar Global team.'
})
</script>

<template>
  <div>
    <section class="relative overflow-hidden bg-limpar-pale">
      <span aria-hidden="true" class="pointer-events-none absolute top-0 right-0 select-none font-heading text-[26rem] font-black leading-none text-limpar-deep/[0.05] sm:-right-6">&rdquo;</span>
      <div class="relative mx-auto max-w-4xl px-4 py-24 sm:px-6 lg:px-8">
        <span class="inline-flex items-center rounded-full bg-white px-4 py-1.5 font-heading text-xs font-bold uppercase tracking-widest text-limpar-deep">Insights</span>
        <h1 class="mt-6 font-heading text-4xl font-extrabold leading-tight text-limpar-ink sm:text-5xl">Thought leadership on African workforce and talent</h1>
        <p class="mt-5 max-w-2xl text-lg leading-relaxed text-limpar-slate">Perspectives, trends and practical thinking on African workforce development, talent readiness and organisational growth — organised around the topics that matter most to the organisations and professionals we work with.</p>
        <div class="mt-8 flex flex-wrap gap-2">
          <span v-for="category in insightCategories" :key="category.title" class="rounded-full border border-limpar-pale-border bg-white px-3.5 py-1.5 text-xs font-semibold text-limpar-deep">
            {{ category.title }}
          </span>
        </div>
      </div>
    </section>

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

        <template v-else>
          <div class="flex flex-col gap-3">
            <span class="inline-flex self-start items-center rounded-full bg-limpar-pale px-4 py-1.5 font-heading text-xs font-bold uppercase tracking-widest text-limpar-deep">What We Cover</span>
            <h2 class="font-heading text-3xl font-bold text-limpar-ink sm:text-4xl">Topics we publish on</h2>
          </div>
          <div class="mt-10 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            <div
              v-for="category in insightCategories"
              :key="category.title"
              class="flex flex-col gap-3 rounded-2xl border border-limpar-pale-border bg-white p-7 shadow-subtle transition-shadow duration-200 hover:shadow-card"
            >
              <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-limpar-deep text-white shadow-soft">
                <AppIcon :name="category.icon" class="h-5 w-5" />
              </div>
              <h3 class="font-heading text-lg font-bold text-limpar-ink">{{ category.title }}</h3>
              <p class="text-sm leading-relaxed text-limpar-slate">{{ category.description }}</p>
            </div>
          </div>

          <div class="mx-auto mt-14 flex max-w-xl flex-col items-center gap-5 rounded-3xl border border-limpar-pale-border bg-limpar-pale px-8 py-16 text-center shadow-subtle">
            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-limpar-deep text-white shadow-soft">
              <AppIcon name="linkedin" class="h-5 w-5" />
            </div>
            <h2 class="font-heading text-xl font-bold text-limpar-ink">New articles are on the way</h2>
            <p class="text-sm leading-relaxed text-limpar-slate">We're preparing our first pieces across these topics. Follow us on LinkedIn to see them as soon as they're published.</p>
            <a
              :href="company.linkedin"
              target="_blank"
              rel="noopener noreferrer"
              class="inline-flex items-center gap-2 rounded-lg bg-limpar-deep px-6 py-3 text-sm font-bold text-white shadow-soft transition-all hover:-translate-y-0.5 hover:bg-limpar-deep-dark hover:shadow-card"
            >
              Follow Limpar Global on LinkedIn
            </a>
          </div>
        </template>
      </div>
    </section>
  </div>
</template>
