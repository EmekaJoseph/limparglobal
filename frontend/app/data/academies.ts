export interface Academy {
  title: string
  description: string
}

// Core Talent Academies
export const academies: Academy[] = [
  {
    title: 'Cybersecurity & Cloud',
    description: 'Building job-ready skills in cybersecurity fundamentals and cloud operations for a fast-growing digital economy.'
  },
  {
    title: 'Revenue Operations, Sales & Customer Success',
    description: 'Practical, employer-aligned capability in revenue operations, sales execution and customer success delivery.'
  },
  {
    title: 'Project, Programme & Business Operations',
    description: 'Structured learning pathways in project delivery, programme coordination and day-to-day business operations.'
  },
  {
    title: 'Finance, Risk & Compliance Operations',
    description: 'Job-ready capability across finance operations, risk management and compliance functions.'
  }
]

// Specialised Workforce Pathways — alongside the core academies
export const pathways: Academy[] = [
  {
    title: 'Energy & Technical',
    description: 'Specialised workforce pathways for technical and energy-sector roles.'
  },
  {
    title: 'Healthcare Operations',
    description: 'Workforce readiness pathways for healthcare operations roles.'
  },
  {
    title: 'Supply Chain, Procurement & Logistics',
    description: 'Practical pathways into supply chain, procurement and logistics operations.'
  }
]
