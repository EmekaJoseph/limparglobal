export interface Pillar {
  number: string
  title: string
  description: string
  to: string
  icon: string
}

export const pillars: Pillar[] = [
  {
    number: '1',
    title: 'Workforce Solutions',
    description: 'Source, place and manage high-quality African talent — from sourcing and onboarding to ongoing workforce administration.',
    to: '/for-employers',
    icon: 'briefcase'
  },
  {
    number: '2',
    title: 'Talent Development',
    description: 'Employer-led academies and specialised pathways that build job-ready skills aligned to real workforce demand.',
    to: '/talent-development',
    icon: 'academic-cap'
  },
  {
    number: '3',
    title: 'Organisational Growth',
    description: 'HR strategy, organisational design and capability building that help organisations scale sustainably.',
    to: '/organisational-solutions',
    icon: 'building'
  }
]
