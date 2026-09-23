export interface SolutionLink {
  label: string
  to: string
  description: string
}

export const solutionLinks: SolutionLink[] = [
  { label: 'For Employers', to: '/for-employers', description: 'Access and manage high-quality African talent' },
  { label: 'For Talent', to: '/for-talent', description: 'Join the Limpar talent ecosystem' },
  { label: 'Talent Development', to: '/talent-development', description: 'Employer-led academies and pathways' },
  { label: 'Organisational Solutions', to: '/organisational-solutions', description: 'HR, organisational development and capacity building' }
]

export const mainNav = [
  { label: 'About', to: '/about' },
  { label: 'Insights', to: '/insights' },
  { label: 'Contact', to: '/contact' }
]

export const footerNav = {
  solutions: solutionLinks.map(({ label, to }) => ({ label, to })),
  company: [
    { label: 'About Limpar', to: '/about' },
    { label: 'Insights', to: '/insights' },
    { label: 'Contact', to: '/contact' }
  ]
}
