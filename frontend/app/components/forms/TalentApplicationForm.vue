<script setup lang="ts">
import {
  countries,
  professionalStatusOptions,
  experienceRangeOptions,
  coreAcademyOptions,
  specialisedVerticalOptions,
  skillLevelOptions,
  opportunityTypeOptions,
  workArrangementOptions,
  learningGoalOptions,
  hoursPerWeekOptions
} from '~/data/formOptions'
const company = useCompanySettings()
import { inputClass, textareaClass, selectClass } from '~/utils/formClasses'

const form = reactive({
  fullName: '',
  email: '',
  phone: '',
  country: '',
  cityState: '',
  linkedin: '',
  portfolio: '',
  status: '',
  experienceRange: '',
  jobTitle: '',
  industry: '',
  cv: null as File | null,
  areaOfInterest: '',
  specificRoles: '',
  currentLevel: '',
  skills: ['', '', '', '', ''],
  tools: '',
  proudProject: '',
  opportunityType: '',
  workArrangement: '',
  preferredLocation: '',
  skillGap: '',
  learningGoal: '',
  hoursPerWeek: '',
  willingAssessment: '',
  willingShared: '',
  whyJoin: '',
  strongCandidate: '',
  anythingElse: '',
  agree: false,
  applicantName: '',
  date: ''
})

const status = ref<'idle' | 'submitting' | 'success' | 'error'>('idle')
const areaOfInterestOptions = [...coreAcademyOptions, ...specialisedVerticalOptions]

const progressSteps = [
  { id: 'ta-step-1', label: 'Personal Information' },
  { id: 'ta-step-2', label: 'Professional Profile' },
  { id: 'ta-step-3', label: 'Area of Interest' },
  { id: 'ta-step-4', label: 'Skills & Experience' },
  { id: 'ta-step-5', label: 'Learning & Development' },
  { id: 'ta-step-6', label: 'Assessment & Verification' },
  { id: 'ta-step-7', label: 'Final Questions' },
  { id: 'ta-step-8', label: 'Declaration & Consent' }
]

const nextSteps = [
  'Review your profile and experience.',
  'Contact you for additional information where required.',
  'Invite you to complete a relevant skills assessment.',
  'Recommend a suitable learning pathway or talent category.',
  'Add you to the relevant Limpar Talent Pool.',
  'Contact you when a suitable opportunity becomes available.'
]

function buildFormData() {
  const fd = new FormData()
  fd.append('full_name', form.fullName)
  fd.append('email', form.email)
  fd.append('phone', form.phone)
  fd.append('country', form.country)
  fd.append('city_state', form.cityState)
  fd.append('linkedin', form.linkedin)
  fd.append('portfolio', form.portfolio)
  fd.append('status', form.status)
  fd.append('experience_range', form.experienceRange)
  fd.append('job_title', form.jobTitle)
  fd.append('industry', form.industry)
  if (form.cv) fd.append('cv', form.cv)
  fd.append('area_of_interest', form.areaOfInterest)
  fd.append('specific_roles', form.specificRoles)
  fd.append('current_level', form.currentLevel)
  form.skills.forEach((skill, i) => fd.append(`skills[${i}]`, skill))
  fd.append('tools', form.tools)
  fd.append('proud_project', form.proudProject)
  fd.append('opportunity_type', form.opportunityType)
  fd.append('work_arrangement', form.workArrangement)
  fd.append('preferred_location', form.preferredLocation)
  fd.append('skill_gap', form.skillGap)
  fd.append('learning_goal', form.learningGoal)
  fd.append('hours_per_week', form.hoursPerWeek)
  fd.append('willing_assessment', form.willingAssessment)
  fd.append('willing_shared', form.willingShared)
  fd.append('why_join', form.whyJoin)
  fd.append('strong_candidate', form.strongCandidate)
  fd.append('anything_else', form.anythingElse)
  fd.append('agree', form.agree ? '1' : '0')
  fd.append('applicant_name', form.applicantName)
  fd.append('date', form.date)
  return fd
}

const submitAttempted = ref(false)
const cvError = computed(() => submitAttempted.value && !form.cv ? 'Please upload your CV.' : '')

async function handleSubmit() {
  submitAttempted.value = true
  if (cvError.value) return
  status.value = 'submitting'
  try {
    await useApi().post('/talent-applications', buildFormData(), {
      headers: { 'Content-Type': 'multipart/form-data' }
    })
    status.value = 'success'
  } catch {
    status.value = 'error'
  }
}
</script>

<template>
  <div id="apply" class="scroll-mt-24">
    <div v-if="status === 'success'" class="flex flex-col items-center gap-4 rounded-3xl border border-limpar-pale-border bg-limpar-pale px-8 py-16 text-center shadow-subtle">
      <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-limpar-deep text-white shadow-soft">
        <AppIcon name="check" class="h-6 w-6" />
      </div>
      <h2 class="font-heading text-2xl font-bold text-limpar-ink">Application received</h2>
      <p class="max-w-md text-sm leading-relaxed text-limpar-slate">Thank you for applying to the Limpar Talent Pool. We'll review your profile and be in touch if there's a fit for our assessment and talent verification process.</p>
    </div>

    <template v-else>
    <FormProgress :steps="progressSteps" />

    <form class="flex flex-col gap-14" @submit.prevent="handleSubmit">
      <FormSection id="ta-step-1" index="Section 1" title="Personal Information">
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
          <FormField label="Full Name" required html-for="ta-full-name">
            <input id="ta-full-name" v-model="form.fullName" type="text" required :class="inputClass">
          </FormField>
          <FormField label="Email Address" required html-for="ta-email">
            <input id="ta-email" v-model="form.email" type="email" required :class="inputClass">
          </FormField>
          <FormField label="Phone / WhatsApp Number" required html-for="ta-phone">
            <input id="ta-phone" v-model="form.phone" type="tel" required :class="inputClass">
          </FormField>
          <FormField label="Country of Residence" required html-for="ta-country">
            <select id="ta-country" v-model="form.country" required :class="selectClass">
              <option value="" disabled>Select country</option>
              <option v-for="c in countries" :key="c" :value="c">{{ c }}</option>
            </select>
          </FormField>
          <FormField label="City / State" required html-for="ta-city">
            <input id="ta-city" v-model="form.cityState" type="text" required :class="inputClass">
          </FormField>
          <FormField label="LinkedIn Profile" required html-for="ta-linkedin">
            <input id="ta-linkedin" v-model="form.linkedin" type="url" placeholder="https://linkedin.com/in/…" required :class="inputClass">
          </FormField>
          <FormField label="Portfolio / Professional Website" help="Optional" html-for="ta-portfolio">
            <input id="ta-portfolio" v-model="form.portfolio" type="url" placeholder="https://…" :class="inputClass">
          </FormField>
        </div>
      </FormSection>

      <FormSection id="ta-step-2" index="Section 2" title="Professional Profile">
        <FormField label="What best describes your current professional status?" required>
          <RadioGroup v-model="form.status" name="ta-status" required :options="professionalStatusOptions" />
        </FormField>
        <FormField label="Years of professional experience" required>
          <RadioGroup v-model="form.experienceRange" name="ta-experience-range" required :options="experienceRangeOptions" />
        </FormField>
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
          <FormField label="Current / Most Recent Job Title" required html-for="ta-job-title">
            <input id="ta-job-title" v-model="form.jobTitle" type="text" required :class="inputClass">
          </FormField>
          <FormField label="Current / Most Recent Industry" required html-for="ta-industry">
            <input id="ta-industry" v-model="form.industry" type="text" required :class="inputClass">
          </FormField>
        </div>
        <FormField label="Upload your CV" required help="PDF preferred" :error="cvError" html-for="ta-cv">
          <FileField id="ta-cv" v-model="form.cv" accept=".pdf,.doc,.docx" />
        </FormField>
      </FormSection>

      <FormSection id="ta-step-3" index="Section 3" title="Area of Interest">
        <FormField label="Which Limpar Talent Academy or Workforce Area are you interested in?" required>
          <RadioGroup v-model="form.areaOfInterest" name="ta-area" required :options="areaOfInterestOptions" />
        </FormField>
        <FormField
          label="Which specific role(s) are you interested in?"
          required
          help="Example: Project Coordinator, Business Operations Associate, Customer Success Associate, Finance Operations Analyst, Procurement Officer, Cybersecurity Analyst."
          html-for="ta-roles"
        >
          <input id="ta-roles" v-model="form.specificRoles" type="text" required :class="inputClass">
        </FormField>
        <FormField label="Select your current level in your chosen area" required>
          <RadioGroup v-model="form.currentLevel" name="ta-level" required :options="skillLevelOptions" />
        </FormField>
      </FormSection>

      <FormSection id="ta-step-4" index="Section 4" title="Skills & Experience">
        <FormField label="What are your top 5 professional or technical skills?" required>
          <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
            <input
              v-for="(skill, i) in form.skills"
              :key="i"
              v-model="form.skills[i]"
              type="text"
              required
              :placeholder="`Skill ${i + 1}`"
              :class="inputClass"
            >
          </div>
        </FormField>
        <FormField
          label="Which tools, software or platforms can you use confidently?"
          required
          help="Example: Microsoft Excel, Power BI, Salesforce, HubSpot, SAP, QuickBooks, Jira, AWS, etc."
          html-for="ta-tools"
        >
          <textarea id="ta-tools" v-model="form.tools" rows="3" required :class="textareaClass" />
        </FormField>
        <FormField label="Briefly describe one project, assignment or piece of work you are particularly proud of." required html-for="ta-project">
          <textarea id="ta-project" v-model="form.proudProject" rows="4" required :class="textareaClass" />
        </FormField>
        <FormField label="What type of opportunity are you currently seeking?" required>
          <RadioGroup v-model="form.opportunityType" name="ta-opportunity" required :options="opportunityTypeOptions" />
        </FormField>
        <FormField label="Preferred work arrangement" required>
          <RadioGroup v-model="form.workArrangement" name="ta-arrangement" required :options="workArrangementOptions" />
        </FormField>
        <FormField label="Preferred location(s)" required html-for="ta-location">
          <input id="ta-location" v-model="form.preferredLocation" type="text" required :class="inputClass">
        </FormField>
      </FormSection>

      <FormSection id="ta-step-5" index="Section 5" title="Learning & Development">
        <FormField label="What is the biggest skill gap you would like to close right now?" required html-for="ta-gap">
          <textarea id="ta-gap" v-model="form.skillGap" rows="3" required :class="textareaClass" />
        </FormField>
        <FormField label="What would you most like Limpar to help you achieve?" required>
          <RadioGroup v-model="form.learningGoal" name="ta-goal" required :options="learningGoalOptions" />
        </FormField>
        <FormField label="How many hours per week can you realistically dedicate to learning and professional development?" required>
          <RadioGroup v-model="form.hoursPerWeek" name="ta-hours" required :options="hoursPerWeekOptions" />
        </FormField>
      </FormSection>

      <FormSection id="ta-step-6" index="Section 6" title="Assessment & Verification" description="To maintain the quality of the Limpar Talent Pool, applicants may be required to complete skills assessments, practical exercises, interviews or other verification activities.">
        <FormField label="Are you willing to participate in Limpar's assessment and talent verification process?" required>
          <RadioGroup v-model="form.willingAssessment" name="ta-willing-assessment" required :options="['Yes', 'No']" />
        </FormField>
        <FormField label="Are you willing to have your professional profile shared with relevant employers when you meet their requirements?" required>
          <RadioGroup v-model="form.willingShared" name="ta-willing-shared" required :options="['Yes', 'No']" />
        </FormField>
      </FormSection>

      <FormSection id="ta-step-7" index="Section 7" title="Final Questions">
        <FormField label="Why do you want to join the Limpar Talent Pool?" required html-for="ta-why">
          <textarea id="ta-why" v-model="form.whyJoin" rows="4" required :class="textareaClass" />
        </FormField>
        <FormField label="What makes you a strong candidate for the type of opportunity you are seeking?" required html-for="ta-strong">
          <textarea id="ta-strong" v-model="form.strongCandidate" rows="4" required :class="textareaClass" />
        </FormField>
        <FormField label="Is there anything else you would like us to know about your experience, skills or career goals?" help="Optional" html-for="ta-else">
          <textarea id="ta-else" v-model="form.anythingElse" rows="3" :class="textareaClass" />
        </FormField>
      </FormSection>

      <FormSection id="ta-step-8" index="Declaration" title="Declaration & Consent">
        <div class="flex flex-col gap-3 text-sm leading-relaxed text-limpar-slate">
          <p>I confirm that the information provided in this application is accurate to the best of my knowledge.</p>
          <p>I understand that submitting this application does not guarantee employment, training admission or placement.</p>
          <p>I consent to Limpar Global using the information provided to assess my skills, communicate relevant learning or employment opportunities, and consider me for suitable talent opportunities.</p>
        </div>
        <label class="flex cursor-pointer items-start gap-3 rounded-lg border border-limpar-pale-border bg-white px-4 py-3 shadow-subtle has-[:checked]:border-limpar-deep has-[:checked]:bg-limpar-pale">
          <input v-model="form.agree" type="checkbox" required class="mt-0.5 h-4 w-4 shrink-0 rounded accent-limpar-deep">
          <span class="text-sm font-semibold text-limpar-ink">I agree to the above.</span>
        </label>
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
          <FormField label="Applicant Name" required html-for="ta-applicant-name">
            <input id="ta-applicant-name" v-model="form.applicantName" type="text" required :class="inputClass">
          </FormField>
          <FormField label="Date" required html-for="ta-date">
            <input id="ta-date" v-model="form.date" type="date" required :class="inputClass">
          </FormField>
        </div>
      </FormSection>

      <div class="flex flex-col gap-4 border-t border-limpar-pale-border pt-8">
        <p v-if="status === 'error'" class="rounded-lg border border-limpar-pale-border bg-limpar-pale px-4 py-3 text-sm text-limpar-ink">
          We couldn't submit your application right now. Please try again, or email your details directly to
          <a :href="`mailto:${company.email}?subject=Join%20the%20Talent%20Pool`" class="font-semibold text-limpar-deep">{{ company.email }}</a>.
        </p>
        <SubmitButton :status="status" label="Submit Application" class="self-start" />
      </div>
    </form>
    </template>

    <div class="mt-14 flex flex-col gap-4 rounded-2xl border border-limpar-pale-border bg-limpar-pale p-8 shadow-subtle">
      <h3 class="font-heading text-lg font-bold text-limpar-ink">What happens next?</h3>
      <p class="text-sm text-limpar-slate">After submitting your application, Limpar may:</p>
      <ol class="flex flex-col gap-2 text-sm text-limpar-ink">
        <li v-for="(step, i) in nextSteps" :key="step" class="flex gap-3">
          <span class="font-heading font-bold text-limpar-deep">{{ i + 1 }}.</span>
          {{ step }}
        </li>
      </ol>
      <p class="text-xs font-semibold text-limpar-slate">Please note: joining the Limpar Talent Pool does not guarantee employment or placement.</p>
    </div>
  </div>
</template>
