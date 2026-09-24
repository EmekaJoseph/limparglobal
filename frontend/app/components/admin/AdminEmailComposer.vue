<script setup lang="ts">
import { inputClass, textareaClass } from '~/utils/formClasses'

const props = defineProps<{
  endpoint: string
  recipientName: string
  recipientEmail: string
  defaultSubject?: string
}>()

const subject = ref(props.defaultSubject ?? '')
const message = ref('')
const sending = ref(false)
const result = ref<{ type: 'success' | 'error', text: string } | null>(null)

async function handleSend() {
  sending.value = true
  result.value = null
  try {
    await useAdminApi().post(props.endpoint, { subject: subject.value, message: message.value })
    result.value = { type: 'success', text: 'Email sent.' }
    message.value = ''
  } catch (err: any) {
    result.value = { type: 'error', text: err.response?.data?.message ?? "Couldn't send the email." }
  } finally {
    sending.value = false
    setTimeout(() => { result.value = null }, 4000)
  }
}
</script>

<template>
  <div class="rounded-2xl border border-limpar-pale-border bg-white p-5 shadow-subtle">
    <div class="mb-4 flex flex-wrap items-center justify-between gap-2">
      <p class="font-heading text-sm font-bold text-limpar-ink">Send an email</p>
      <span class="text-xs text-limpar-slate">To: {{ recipientName }} &lt;{{ recipientEmail }}&gt;</span>
    </div>

    <div class="space-y-3">
      <div>
        <label class="mb-1.5 block text-sm font-medium text-limpar-ink">Subject</label>
        <input v-model="subject" type="text" placeholder="Subject line…" :class="inputClass">
      </div>
      <div>
        <label class="mb-1.5 block text-sm font-medium text-limpar-ink">Message</label>
        <textarea v-model="message" rows="5" placeholder="Write your message…" :class="textareaClass" />
      </div>
    </div>

    <div class="mt-4 flex flex-wrap items-center gap-3">
      <button
        type="button"
        class="flex items-center gap-2 rounded-lg bg-limpar-deep px-4 py-2 text-sm font-semibold text-white transition-colors hover:bg-limpar-deep-dark disabled:cursor-not-allowed disabled:opacity-60"
        :disabled="sending || !subject.trim() || !message.trim()"
        @click="handleSend"
      >
        <AppIcon :name="sending ? 'spinner' : 'mail'" class="h-4 w-4" :class="{ 'animate-spin': sending }" />
        {{ sending ? 'Sending…' : 'Send email' }}
      </button>
      <span v-if="result" class="text-sm" :class="result.type === 'success' ? 'text-emerald-600' : 'text-rose-600'">{{ result.text }}</span>
    </div>
  </div>
</template>
