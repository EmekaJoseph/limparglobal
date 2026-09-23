<script setup lang="ts">
import { company } from '~/data/company'

usePageSeo({
  title: 'Terms of Use',
  description: 'The terms that govern your use of the Limpar Global website.'
})

const lastUpdated = 'September 23, 2026'
</script>

<template>
  <div>
    <PageHero
      eyebrow="Legal"
      title="Terms of Use"
      :description="`Last updated: ${lastUpdated}`"
    />

    <section class="bg-white">
      <div class="mx-auto max-w-3xl px-4 py-16 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-10 text-base leading-relaxed text-limpar-slate [&_h2]:font-heading [&_h2]:text-xl [&_h2]:font-bold [&_h2]:text-limpar-ink [&_h2]:mb-3 [&_ul]:list-disc [&_ul]:pl-5 [&_ul]:flex [&_ul]:flex-col [&_ul]:gap-1.5 [&_a]:text-limpar-deep [&_a]:font-semibold">
          <div>
            <p>These Terms of Use govern your access to and use of the Limpar Global website. By using this website, you agree to these terms. If you do not agree, please do not use this website.</p>
          </div>

          <div>
            <h2>Use of This Website</h2>
            <p>This website is provided to share information about Limpar Global's workforce solutions, talent development and organisational growth services. You may browse and use it for lawful, informational purposes only.</p>
          </div>

          <div>
            <h2>Intellectual Property</h2>
            <p>The Limpar Global name, logo, and the content, design and layout of this website are the property of Limpar Global unless otherwise noted, and may not be copied, reproduced or used without our prior written permission.</p>
          </div>

          <div>
            <h2>No Professional Advice</h2>
            <p>Content on this website is provided for general informational purposes only and does not constitute professional, legal, financial or employment advice. Specific engagements are governed by separate agreements between Limpar Global and the relevant party.</p>
          </div>

          <div>
            <h2>Links to Third-Party Sites</h2>
            <p>This website may link to third-party sites, such as LinkedIn. We are not responsible for the content, accuracy or practices of external sites.</p>
          </div>

          <div>
            <h2>Disclaimer &amp; Limitation of Liability</h2>
            <p>This website is provided "as is" without warranties of any kind. To the fullest extent permitted by law, Limpar Global is not liable for any loss or damage arising from your use of this website.</p>
          </div>

          <div>
            <h2>Changes to These Terms</h2>
            <p>We may update these terms from time to time. Changes will be posted on this page with an updated "Last updated" date.</p>
          </div>

          <div>
            <h2>Governing Law</h2>
            <p>These terms are governed by the laws of the jurisdiction in which Limpar Global operates. <span class="italic text-limpar-slate/70">[Placeholder — to be confirmed with Limpar Global's registered jurisdiction.]</span></p>
          </div>

          <div>
            <h2>Contact Us</h2>
            <p>Questions about these terms can be sent to <a :href="`mailto:${company.email}`">{{ company.email }}</a>.</p>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>
