export interface InsightCategory {
  title: string
  description: string
  icon: string
}

export const insightCategories: InsightCategory[] = [
  {
    title: 'African Workforce',
    description: 'Trends, dynamics and data shaping labour markets and talent pools across Africa.',
    icon: 'globe'
  },
  {
    title: 'Talent & Skills',
    description: 'Skills development, workforce readiness and what it takes to build job-ready capability.',
    icon: 'academic-cap'
  },
  {
    title: 'Workforce & Organisational Growth',
    description: 'HR strategy, organisational development and building the capability to scale.',
    icon: 'building'
  },
  {
    title: 'The Future of Work',
    description: 'How work, skills and employment are evolving — and what it means for organisations and talent.',
    icon: 'compass'
  },
  {
    title: 'Industry Workforce',
    description: 'Sector-specific workforce and talent perspectives across the industries we serve.',
    icon: 'briefcase'
  },
  {
    title: "Limpar's Perspectives",
    description: "Limpar's own views, commentary and lessons from the work we do.",
    icon: 'target'
  }
]
