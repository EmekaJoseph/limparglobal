export interface NormalizedPage<T> {
  items: T[]
  currentPage: number
  lastPage: number
  total: number
}

// The admin API returns two different Laravel pagination shapes:
// - JsonResource::collection(paginate()) -> { data, meta: { current_page, last_page, total } }
// - a raw LengthAwarePaginator via response()->json() -> { data, current_page, last_page, total }
// This normalizes either into one shape the admin UI can render against.
export function normalizePage<T>(payload: any): NormalizedPage<T> {
  const meta = payload?.meta ?? payload ?? {}
  const items: T[] = payload?.data ?? []

  return {
    items,
    currentPage: meta.current_page ?? 1,
    lastPage: meta.last_page ?? 1,
    total: meta.total ?? items.length
  }
}
