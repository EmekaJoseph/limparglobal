// Shared option lists for the Talent Application and Employer Request forms.

export const countries: string[] = [
  'Algeria', 'Angola', 'Benin', 'Botswana', 'Burkina Faso', 'Burundi', 'Cabo Verde', 'Cameroon',
  'Central African Republic', 'Chad', 'Comoros', 'Congo (Brazzaville)', 'Congo (DRC)', 'Djibouti',
  'Egypt', 'Equatorial Guinea', 'Eritrea', 'Eswatini', 'Ethiopia', 'Gabon', 'Gambia', 'Ghana',
  'Guinea', 'Guinea-Bissau', 'Ivory Coast', 'Kenya', 'Lesotho', 'Liberia', 'Libya', 'Madagascar',
  'Malawi', 'Mali', 'Mauritania', 'Mauritius', 'Morocco', 'Mozambique', 'Namibia', 'Niger',
  'Nigeria', 'Rwanda', 'Sao Tome and Principe', 'Senegal', 'Seychelles', 'Sierra Leone', 'Somalia',
  'South Africa', 'South Sudan', 'Sudan', 'Tanzania', 'Togo', 'Tunisia', 'Uganda', 'Zambia',
  'Zimbabwe',
  'United Kingdom', 'United States', 'Canada', 'United Arab Emirates', 'Saudi Arabia', 'Other'
]

export const professionalStatusOptions = [
  'Student',
  'Recent Graduate',
  'Early-Career Professional',
  'Mid-Career Professional',
  'Experienced Professional',
  'Freelancer / Independent Professional',
  'Currently seeking employment',
  'Other'
]

export const experienceRangeOptions = [
  'Less than 1 year',
  '1–2 years',
  '3–5 years',
  '6–10 years',
  '10+ years'
]

export const coreAcademyOptions = [
  'Cybersecurity & Cloud',
  'Revenue Operations, Sales & Customer Success',
  'Project, Programme & Business Operations',
  'Finance, Risk & Compliance Operations'
]

export const specialisedVerticalOptions = [
  'Energy & Technical',
  'Healthcare Operations',
  'Supply Chain, Procurement & Logistics',
  'Other / Not sure yet'
]

export const talentAreaOptions = [...coreAcademyOptions, ...specialisedVerticalOptions.filter((o) => o !== 'Other / Not sure yet'), 'Other']

export const skillLevelOptions = [
  'Beginner / Exploring',
  'Foundational',
  'Intermediate',
  'Experienced',
  'Advanced / Specialist'
]

export const opportunityTypeOptions = [
  'Full-time employment',
  'Part-time employment',
  'Contract work',
  'Freelance / Project work',
  'Internship',
  'Graduate opportunity',
  'Apprenticeship',
  'Open to opportunities'
]

export const workArrangementOptions = [
  'Remote',
  'Hybrid',
  'On-site',
  'Flexible / Any'
]

export const learningGoalOptions = [
  'Become job-ready',
  'Develop a specialised skill',
  'Transition into a new career',
  'Become more competitive for international opportunities',
  'Build a professional portfolio',
  'Prepare for a professional certification',
  'Access employment opportunities',
  'Access contract/freelance opportunities',
  'Other'
]

export const hoursPerWeekOptions = [
  'Less than 5 hours',
  '5–10 hours',
  '10–15 hours',
  '15+ hours'
]

// Employer form option lists

export const supportTypeOptions = [
  'Talent Recruitment / Placement',
  'Contract / Outsourced Workforce',
  'Workforce Development / Upskilling',
  'Internship / Graduate Talent',
  'Project-Based Talent',
  'Other'
]

export const timelineOptions = [
  'Immediately',
  'Within 30 days',
  '1–3 months',
  '3–6 months',
  'Future / Planning ahead'
]

export const employerExperienceLevelOptions = [
  'Entry / Graduate',
  'Junior',
  'Mid-level',
  'Senior',
  'Specialist'
]

export const employerWorkArrangementOptions = [
  'Remote',
  'Hybrid',
  'On-site',
  'Flexible'
]

export const limparHelpOptions = [
  'Source candidates',
  'Assess candidates',
  'Develop / train candidates',
  'Verify talent capability',
  'Shortlist candidates',
  'Manage placed/contract staff',
  'Support onboarding and HR administration',
  "I'm not sure yet — I'd like to discuss"
]
