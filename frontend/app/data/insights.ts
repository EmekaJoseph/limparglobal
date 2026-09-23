export interface InsightPost {
  title: string
  excerpt: string
  url: string
  date: string
  category?: string
}

// Add real LinkedIn articles / posts here as they're published.
// The Insights page shows a "follow us" empty state while this is empty.
export const insights: InsightPost[] = []
