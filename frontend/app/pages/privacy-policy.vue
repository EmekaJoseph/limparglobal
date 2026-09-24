<script setup lang="ts">
const company = useCompanySettings()

usePageSeo({
  title: 'Privacy Policy',
  description: 'How Limpar Global collects, uses and protects information when you visit this website or contact us.'
})

const lastUpdated = 'September 23, 2026'
</script>

<template>
  <div>
    <PageHero
      eyebrow="Legal"
      title="Privacy Policy"
      :description="`Last updated: ${lastUpdated}`"
    />

    <section class="bg-white">
      <div class="mx-auto max-w-3xl px-4 py-16 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-10 text-base leading-relaxed text-limpar-slate [&_h2]:font-heading [&_h2]:text-xl [&_h2]:font-bold [&_h2]:text-limpar-ink [&_h2]:mb-3 [&_ul]:list-disc [&_ul]:pl-5 [&_ul]:flex [&_ul]:flex-col [&_ul]:gap-1.5 [&_a]:text-limpar-deep [&_a]:font-semibold">
          <div>
            <p>Limpar Global ("Limpar", "we", "us" or "our") respects your privacy. This policy explains what information we collect through this website, how we use it, and the choices you have.</p>
          </div>

          <div>
            <h2>Information We Collect</h2>
            <p class="mb-3">We collect information in the following ways:</p>
            <ul>
              <li><strong>Information you provide directly.</strong> If you email us, we receive whatever you include — typically your name, email address and message. If you complete the Talent Application Form or the Employer Talent &amp; Workforce Request Form on this site, we collect the information you submit, which may include your name, contact details (email, phone/WhatsApp), location, LinkedIn or portfolio links, professional or organisational details, information about your skills, experience or workforce needs, and any documents you upload (such as a CV or job description).</li>
              <li><strong>Standard technical information.</strong> Like most websites, our hosting provider automatically logs basic technical data (such as IP address, browser type and pages visited) for security and operational purposes.</li>
            </ul>
          </div>

          <div>
            <h2>Cookies &amp; Tracking</h2>
            <p>This website does not currently use cookies for analytics, advertising or tracking. If that changes in future, we will update this policy to describe what is used and why.</p>
          </div>

          <div>
            <h2>Third-Party Services</h2>
            <p>This site loads typefaces from Google Fonts. As part of delivering those fonts, Google may process your IP address in accordance with the <a href="https://policies.google.com/privacy" target="_blank" rel="noopener noreferrer">Google Privacy Policy</a>.</p>
          </div>

          <div>
            <h2>How We Use Information</h2>
            <ul>
              <li>To respond to your enquiries and requests</li>
              <li>To process talent applications and employer workforce requests submitted through our forms</li>
              <li>To assess and connect talent with relevant organisations and opportunities</li>
              <li>To provide information about our workforce, talent development and organisational solutions</li>
              <li>To maintain the security and performance of our website</li>
            </ul>
          </div>

          <div>
            <h2>How We Share Information</h2>
            <p>We do not sell your personal information. We may share it with service providers who help us operate (such as our email or hosting provider), or where required by law. If you apply to join the Limpar Talent Pool, we may share relevant parts of your profile with organisations seeking talent through Limpar, as part of our workforce matching services. Information submitted through the Employer Talent &amp; Workforce Request Form is used to identify and propose suitable talent for that request and is not sold or shared beyond this purpose.</p>
          </div>

          <div>
            <h2>Data Retention</h2>
            <p>We retain information from your enquiries, talent applications and workforce requests only for as long as reasonably necessary to respond to you, process your submission and manage our relationship with you or your organisation.</p>
          </div>

          <div>
            <h2>Your Rights</h2>
            <p>Depending on your location, you may have rights to access, correct or request deletion of your personal information. To exercise these rights, contact us at <a :href="`mailto:${company.email}`">{{ company.email }}</a>.</p>
          </div>

          <div>
            <h2>Children's Privacy</h2>
            <p>This website is intended for organisations and working professionals, and is not directed at children.</p>
          </div>

          <div>
            <h2>Changes to This Policy</h2>
            <p>We may update this policy from time to time. Changes will be posted on this page with an updated "Last updated" date.</p>
          </div>

          <div>
            <h2>Contact Us</h2>
            <p>Questions about this policy can be sent to <a :href="`mailto:${company.email}`">{{ company.email }}</a>.</p>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>
