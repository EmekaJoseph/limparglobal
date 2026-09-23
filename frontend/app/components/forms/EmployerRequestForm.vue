<script setup lang="ts">
import {
  supportTypeOptions,
  talentAreaOptions,
  timelineOptions,
  employerExperienceLevelOptions,
  employerWorkArrangementOptions,
  limparHelpOptions
} from '~/data/formOptions'
import { company } from '~/data/company'
import { inputClass, textareaClass } from '~/utils/formClasses'

const form = reactive({
  orgName: '',
  website: '',
  industry: '',
  location: '',
  contactName: '',
  jobTitle: '',
  email: '',
  phone: '',
  supportTypes: [] as string[],
  talentAreas: [] as string[],
  roles: '',
  headcount: '',
  timeline: '',
  experienceLevel: '',
  workArrangement: '',
  talentLocation: '',
  roleDescription: '',
  keySkills: '',
  hasJD: '',
  jdFile: null as File | null,
  helpNeeded: [] as string[],
  anythingElse: '',
  consent: false
})

const status = ref<'idle' | 'submitting' | 'success' | 'error'>('idle')
const submitAttempted = ref(false)

const progressSteps = [
  { id: 'er-step-1', label: 'Organisation' },
  { id: 'er-step-2', label: 'What Do You Need?' },
  { id: 'er-step-3', label: 'Talent Requirement' },
  { id: 'er-step-4', label: 'What Are You Looking For?' },
  { id: 'er-step-5', label: 'How Can Limpar Help?' },
  { id: 'er-step-6', label: 'Submit Your Request' }
]

const supportTypesError = computed(() => submitAttempted.value && form.supportTypes.length === 0 ? 'Please select at least one option.' : '')
const talentAreasError = computed(() => submitAttempted.value && form.talentAreas.length === 0 ? 'Please select at least one option.' : '')
const helpNeededError = computed(() => submitAttempted.value && form.helpNeeded.length === 0 ? 'Please select at least one option.' : '')
const hasCheckboxGroupErrors = computed(() => !!(supportTypesError.value || talentAreasError.value || helpNeededError.value))

function buildFormData() {
  const fd = new FormData()
  fd.append('organisation_name', form.orgName)
  fd.append('website', form.website)
  fd.append('industry', form.industry)
  fd.append('location', form.location)
  fd.append('contact_name', form.contactName)
  fd.append('job_title', form.jobTitle)
  fd.append('email', form.email)
  fd.append('phone', form.phone)
  form.supportTypes.forEach((v, i) => fd.append(`support_types[${i}]`, v))
  form.talentAreas.forEach((v, i) => fd.append(`talent_areas[${i}]`, v))
  fd.append('roles', form.roles)
  fd.append('headcount', form.headcount)
  fd.append('timeline', form.timeline)
  fd.append('experience_level', form.experienceLevel)
  fd.append('work_arrangement', form.workArrangement)
  fd.append('talent_location', form.talentLocation)
  fd.append('role_description', form.roleDescription)
  fd.append('key_skills', form.keySkills)
  fd.append('has_jd', form.hasJD)
  if (form.jdFile) fd.append('jd_file', form.jdFile)
  form.helpNeeded.forEach((v, i) => fd.append(`help_needed[${i}]`, v))
  fd.append('anything_else', form.anythingElse)
  fd.append('consent', form.consent ? '1' : '0')
  return fd
}

async function handleSubmit() {
  submitAttempted.value = true
  if (hasCheckboxGroupErrors.value) return
  status.value = 'submitting'
  try {
    await useApi().post('/employer-requests', buildFormData(), {
      headers: { 'Content-Type': 'multipart/form-data' }
    })
    status.value = 'success'
  } catch {
    status.value = 'error'
  }
}
</script>

<template>
  <div id="request" class="scroll-mt-24">
    <div v-if="status === 'success'" class="flex flex-col items-center gap-4 rounded-3xl border border-limpar-pale-border bg-limpar-pale px-8 py-16 text-center shadow-subtle">
      <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-limpar-deep text-white shadow-soft">
        <AppIcon name="check" class="h-6 w-6" />
      </div>
      <h2 class="font-heading text-2xl font-bold text-limpar-ink">Request received</h2>
      <p class="max-w-md text-sm leading-relaxed text-limpar-slate">Thank you for your workforce request. A Limpar representative will review it and contact you to clarify the role, timeline and required talent profile.</p>
    </div>

    <template v-else>
    <FormProgress :steps="progressSteps" />

    <form class="flex flex-col gap-14" @submit.prevent="handleSubmit">
      <FormSection id="er-step-1" index="1" title="Organisation">
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
          <FormField label="Organisation Name" required html-for="er-org-name">
            <input id="er-org-name" v-model="form.orgName" type="text" required :class="inputClass">
          </FormField>
          <FormField label="Website" required html-for="er-website">
            <input id="er-website" v-model="form.website" type="url" placeholder="https://…" required :class="inputClass">
          </FormField>
          <FormField label="Industry / Sector" required html-for="er-industry">
            <input id="er-industry" v-model="form.industry" type="text" required :class="inputClass">
          </FormField>
          <FormField label="Country / Location" required html-for="er-location">
            <input id="er-location" v-model="form.location" type="text" required :class="inputClass">
          </FormField>
          <FormField label="Your Name" required html-for="er-contact-name">
            <input id="er-contact-name" v-model="form.contactName" type="text" required :class="inputClass">
          </FormField>
          <FormField label="Job Title / Role" required html-for="er-job-title">
            <input id="er-job-title" v-model="form.jobTitle" type="text" required :class="inputClass">
          </FormField>
          <FormField label="Email Address" required html-for="er-email">
            <input id="er-email" v-model="form.email" type="email" required :class="inputClass">
          </FormField>
          <FormField label="Phone / WhatsApp" required html-for="er-phone">
            <input id="er-phone" v-model="form.phone" type="tel" required :class="inputClass">
          </FormField>
        </div>
      </FormSection>

      <FormSection id="er-step-2" index="2" title="What Do You Need?">
        <FormField label="What type of support are you looking for?" required :error="supportTypesError">
          <CheckboxGroup v-model="form.supportTypes" name="er-support-types" :options="supportTypeOptions" />
        </FormField>
        <FormField label="Which talent area do you need?" required :error="talentAreasError">
          <CheckboxGroup v-model="form.talentAreas" name="er-talent-areas" :options="talentAreaOptions" />
        </FormField>
      </FormSection>

      <FormSection id="er-step-3" index="3" title="Talent Requirement">
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
          <FormField label="What role(s) are you looking to fill?" required html-for="er-roles">
            <input id="er-roles" v-model="form.roles" type="text" required :class="inputClass">
          </FormField>
          <FormField label="How many people do you need?" required html-for="er-headcount">
            <input id="er-headcount" v-model="form.headcount" type="number" min="1" required :class="inputClass">
          </FormField>
        </div>
        <FormField label="When do you need them?" required>
          <RadioGroup v-model="form.timeline" name="er-timeline" required :options="timelineOptions" />
        </FormField>
        <FormField label="Experience level required" required>
          <RadioGroup v-model="form.experienceLevel" name="er-experience-level" required :options="employerExperienceLevelOptions" />
        </FormField>
        <FormField label="Preferred work arrangement" required>
          <RadioGroup v-model="form.workArrangement" name="er-work-arrangement" required :options="employerWorkArrangementOptions" />
        </FormField>
        <FormField label="Where will the talent be based?" required html-for="er-talent-location">
          <input id="er-talent-location" v-model="form.talentLocation" type="text" required :class="inputClass">
        </FormField>
      </FormSection>

      <FormSection id="er-step-4" index="4" title="What Are You Looking For?">
        <FormField label="Briefly describe the role, key responsibilities and skills required." required html-for="er-role-description">
          <textarea id="er-role-description" v-model="form.roleDescription" rows="5" required :class="textareaClass" />
        </FormField>
        <FormField label="What are the 3–5 most important skills or qualifications?" required html-for="er-key-skills">
          <textarea id="er-key-skills" v-model="form.keySkills" rows="4" required :class="textareaClass" />
        </FormField>
        <FormField label="Do you already have a Job Description?" required>
          <RadioGroup
            v-model="form.hasJD"
            name="er-has-jd"
            required
            :options="['Yes — I will upload it below', 'No — I would like Limpar to help define the role']"
          />
        </FormField>
        <FormField label="Upload Job Description / Requirements" help="Optional" html-for="er-jd-file">
          <FileField id="er-jd-file" v-model="form.jdFile" accept=".pdf,.doc,.docx" />
        </FormField>
      </FormSection>

      <FormSection id="er-step-5" index="5" title="How Can Limpar Help?">
        <FormField label="What would you like Limpar to do?" required :error="helpNeededError">
          <CheckboxGroup v-model="form.helpNeeded" name="er-help-needed" :options="limparHelpOptions" />
        </FormField>
        <FormField label="Anything else we should know about your requirement?" help="Optional" html-for="er-anything-else">
          <textarea id="er-anything-else" v-model="form.anythingElse" rows="3" :class="textareaClass" />
        </FormField>
      </FormSection>

      <div id="er-step-6" class="flex flex-col gap-6 border-t-2 border-limpar-deep pt-8 scroll-mt-44 lg:scroll-mt-52">
        <h3 class="font-heading text-xl font-bold text-limpar-ink sm:text-2xl">Submit Your Request</h3>
        <label class="flex cursor-pointer items-start gap-3 rounded-lg border border-limpar-pale-border bg-white px-4 py-3 shadow-subtle has-[:checked]:border-limpar-deep has-[:checked]:bg-limpar-pale">
          <input v-model="form.consent" type="checkbox" required class="mt-0.5 h-4 w-4 shrink-0 rounded accent-limpar-deep">
          <span class="text-sm font-semibold text-limpar-ink">I consent to Limpar Global contacting me regarding this workforce request.</span>
        </label>
        <p v-if="status === 'error'" class="rounded-lg border border-limpar-pale-border bg-limpar-pale px-4 py-3 text-sm text-limpar-ink">
          We couldn't submit your request right now. Please try again, or email your details directly to
          <a :href="`mailto:${company.email}?subject=Workforce%20Needs`" class="font-semibold text-limpar-deep">{{ company.email }}</a>.
        </p>
        <SubmitButton :status="status" label="Submit Request" class="self-start" />
      </div>
    </form>
    </template>

    <div class="mt-14 flex flex-col gap-3 rounded-2xl border border-limpar-pale-border bg-limpar-pale p-8 shadow-subtle">
      <h3 class="font-heading text-lg font-bold text-limpar-ink">What happens next?</h3>
      <p class="text-sm leading-relaxed text-limpar-slate">A Limpar representative will review your requirement and contact you to clarify the role, timeline and required talent profile.</p>
    </div>
  </div>
</template>
