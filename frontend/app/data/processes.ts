export interface ProcessStep {
  icon: string
  label: string
}

// Employer workforce process (For Employers page)
export const employerProcess: ProcessStep[] = [
  { icon: 'target', label: 'Define the need' },
  { icon: 'search', label: 'Source' },
  { icon: 'shield-check', label: 'Assess' },
  { icon: 'academic-cap', label: 'Develop' },
  { icon: 'check', label: 'Verify' },
  { icon: 'map-pin', label: 'Place' },
  { icon: 'briefcase', label: 'Manage' }
]

// Talent development process (For Talent / Talent Development pages)
export const talentProcess: ProcessStep[] = [
  { icon: 'academic-cap', label: 'Learn' },
  { icon: 'layers', label: 'Practise' },
  { icon: 'shield-check', label: 'Assess' },
  { icon: 'check', label: 'Verify' },
  { icon: 'globe', label: 'Connect to Opportunity' }
]

// Organisational growth process (Organisational Solutions page)
export const orgProcess: ProcessStep[] = [
  { icon: 'compass', label: 'Understand' },
  { icon: 'layers', label: 'Design' },
  { icon: 'building', label: 'Build' },
  { icon: 'bolt', label: 'Implement' },
  { icon: 'trending-up', label: 'Measure' }
]

// Full platform pipeline (About / Home)
export const platformPipeline: ProcessStep[] = [
  { icon: 'briefcase', label: 'Employer Demand' },
  { icon: 'academic-cap', label: 'Talent Development' },
  { icon: 'shield-check', label: 'Assessment' },
  { icon: 'check', label: 'Talent Verification' },
  { icon: 'map-pin', label: 'Placement' },
  { icon: 'users', label: 'Workforce Management' }
]
