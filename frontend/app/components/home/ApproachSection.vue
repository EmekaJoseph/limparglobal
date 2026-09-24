<script setup lang="ts">
import { orgProcess, talentProcess } from '~/data/processes'
</script>

<template>
  <section class="bg-white">
    <div class="mx-auto max-w-8xl px-4 py-20 sm:px-6 lg:px-8">
      <div class="mx-auto flex max-w-2xl flex-col gap-4 text-center">
        <span class="inline-flex self-start items-center rounded-full bg-limpar-pale px-4 py-1.5 font-heading text-xs font-bold uppercase tracking-widest text-limpar-deep">Our Approach</span>
        <h2 class="font-heading text-3xl font-bold text-limpar-ink sm:text-4xl">Strategy, people and execution — working together</h2>
        <p class="text-base leading-relaxed text-limpar-slate">Organisations don't grow simply by hiring more people or providing more training. They grow when strategy, people, capabilities, processes and execution work together.</p>
      </div>
      <div class="mx-auto mt-14 flex max-w-5xl flex-col gap-8">
        <div class="rounded-2xl border border-limpar-pale-border bg-limpar-pale p-8 shadow-subtle">
          <h3 class="font-heading text-lg font-bold text-limpar-ink">For Organisations</h3>
          <div class="mt-6">
            <ProcessSteps :steps="orgProcess" />
          </div>
        </div>
        <div class="rounded-2xl border border-limpar-pale-border bg-limpar-pale p-8 shadow-subtle">
          <h3 class="font-heading text-lg font-bold text-limpar-ink">For Talent</h3>
          <div class="mt-6">
            <ProcessSteps :steps="talentProcess" />
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
