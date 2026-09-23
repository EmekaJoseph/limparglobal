<script setup lang="ts">
defineProps<{
  name: string
}>()
</script>

<template>
  <svg
    xmlns="http://www.w3.org/2000/svg"
    viewBox="0 0 24 24"
    fill="none"
    stroke="currentColor"
    stroke-width="1.6"
    stroke-linecap="round"
    stroke-linejoin="round"
  >
    <template v-if="name === 'menu'">
      <path d="M4 7h16M4 12h16M4 17h16" />
    </template>

    <template v-else-if="name === 'close'">
      <path d="M6 6l12 12M18 6L6 18" />
    </template>

    <template v-else-if="name === 'arrow-right'">
      <path d="M4 12h16" />
      <path d="M14 6l6 6-6 6" />
    </template>

    <template v-else-if="name === 'chevron-down'">
      <path d="M6 9l6 6 6-6" />
    </template>

    <template v-else-if="name === 'chevron-right'">
      <path d="M9 6l6 6-6 6" />
    </template>

    <template v-else-if="name === 'mail'">
      <rect x="3" y="5" width="18" height="14" rx="2" />
      <path d="M3.5 6.5l8.5 6.5 8.5-6.5" />
    </template>

    <template v-else-if="name === 'linkedin'">
      <rect x="3.5" y="3.5" width="17" height="17" rx="3" />
      <path d="M8 10.5v6M8 7.8v.01" />
      <path d="M12 16.5v-3.6c0-1.3 1-2.4 2.2-2.4 1.3 0 2.3 1 2.3 2.4v3.6" />
      <path d="M12 12.9v3.6" />
    </template>

    <template v-else-if="name === 'briefcase'">
      <rect x="3" y="8" width="18" height="12" rx="2" />
      <path d="M8 8V6a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
      <path d="M3 13h18" />
    </template>

    <template v-else-if="name === 'academic-cap'">
      <path d="M3 9l9-4 9 4-9 4-9-4Z" />
      <path d="M7 11v4c0 1.4 2.2 2.5 5 2.5s5-1.1 5-2.5v-4" />
      <path d="M21 9v5" />
    </template>

    <template v-else-if="name === 'building'">
      <rect x="5" y="3" width="10" height="18" rx="1" />
      <rect x="15" y="9" width="4" height="12" rx="1" />
      <path d="M8 7h1M11 7h1M8 11h1M11 11h1M8 15h1M11 15h1" />
    </template>

    <template v-else-if="name === 'users'">
      <circle cx="9" cy="9" r="3" />
      <path d="M3 19c0-3 2.7-5.5 6-5.5s6 2.5 6 5.5" />
      <path d="M16 8.2a3 3 0 1 1 0 5.8" />
      <path d="M21 19c0-2.3-1.6-4.3-3.8-5.1" />
    </template>

    <template v-else-if="name === 'target'">
      <circle cx="12" cy="12" r="8" />
      <circle cx="12" cy="12" r="4" />
      <circle cx="12" cy="12" r="0.6" fill="currentColor" stroke="none" />
    </template>

    <template v-else-if="name === 'globe'">
      <circle cx="12" cy="12" r="8.5" />
      <path d="M3.5 12h17M12 3.5c2.5 2.3 3.8 5.3 3.8 8.5s-1.3 6.2-3.8 8.5c-2.5-2.3-3.8-5.3-3.8-8.5S9.5 5.8 12 3.5Z" />
    </template>

    <template v-else-if="name === 'layers'">
      <path d="M12 3l8 4.5-8 4.5-8-4.5L12 3Z" />
      <path d="M4 12l8 4.5 8-4.5" />
      <path d="M4 16.2l8 4.5 8-4.5" />
    </template>

    <template v-else-if="name === 'check'">
      <path d="M5 13l4.5 4.5L19 7" />
    </template>

    <template v-else-if="name === 'shield-check'">
      <path d="M12 3l7 3v6c0 4.5-3 7.5-7 9-4-1.5-7-4.5-7-9V6l7-3Z" />
      <path d="M9 12l2 2 4-4" />
    </template>

    <template v-else-if="name === 'puzzle'">
      <path d="M9 4h4v2.2a1.6 1.6 0 0 0 3 0V4h4v4h-2.2a1.6 1.6 0 0 0 0 3H20v4h-4v-2.2a1.6 1.6 0 0 0-3 0V15H9v-4H6.8a1.6 1.6 0 0 1 0-3H9V4Z" />
    </template>

    <template v-else-if="name === 'compass'">
      <circle cx="12" cy="12" r="8.5" />
      <path d="M15 9l-2 6-4-2 2-6 4 2Z" />
    </template>

    <template v-else-if="name === 'trending-up'">
      <path d="M3 16l6-6 4 4 8-8" />
      <path d="M15 6h6v6" />
    </template>

    <template v-else-if="name === 'upload'">
      <path d="M12 15V4" />
      <path d="M7.5 8.5 12 4l4.5 4.5" />
      <path d="M4 15v3a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-3" />
    </template>

    <template v-else-if="name === 'spinner'">
      <path d="M12 3a9 9 0 1 0 9 9" />
    </template>
  </svg>
</template>
