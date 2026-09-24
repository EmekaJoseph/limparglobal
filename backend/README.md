# Limpar Global — Backend API

A Laravel API-only backend (no Blade views) for the Limpar Global admin side: authentication, site settings, form submissions from the frontend, and a lightweight visitor log.

## Stack

- Laravel 11, PHP 8.3
- MySQL (`limparglobal` database)
- Laravel Sanctum for token-based admin authentication (`Authorization: Bearer <token>`, not cookies — works from any frontend origin)

## Setup

```bash
composer install
cp .env.example .env   # already done for local dev; adjust DB_* / FRONTEND_URL as needed
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

By default this runs on `http://127.0.0.1:8000`, which matches the frontend's default `apiBaseUrl` (`http://localhost:8000/api` in `frontend/nuxt.config.ts`). If port 8000 is already taken by something else on your machine, run `php artisan serve --port=8001` and update `NUXT_PUBLIC_API_BASE_URL` (or the frontend's runtime config) to match.

## Default admin login

Seeded by `AdminSeeder`, values read from `.env`:

- **Email:** `admin@limparglobal.org`
- **Password:** `LimparAdmin#2026`

**Change this password immediately** via `PUT /api/admin/security/password` after first login — there's no other account, so don't lose access to it. To reset it back to the `.env` default at any time: `php artisan db:seed --class=AdminSeeder`.

Note: if you ever put a password containing `#` directly in `.env`, wrap it in quotes (`ADMIN_DEFAULT_PASSWORD="Some#Pass"`) — an unquoted `#` starts a comment in `.env` files and silently truncates the value.

## API routes

All routes are prefixed with `/api`. Public routes need no auth; everything under `/api/admin/*` requires `Authorization: Bearer <token>` from `/api/login`.

**Public**
- `POST /login` — `{ email, password }` → `{ admin, token }`
- `POST /talent-applications` — receives the frontend's Talent Application Form (multipart, includes `cv` file)
- `POST /employer-requests` — receives the frontend's Employer Talent & Workforce Request Form (multipart, `jd_file` optional)
- `POST /track-visit` — `{ path?, referrer? }`, logs the caller's IP + user agent. **Not yet called by the frontend** — that instrumentation is frontend work for later.

**Authenticated**
- `POST /logout`
- `GET /me`
- `GET /admin/dashboard` — summary counts (applications, requests, visitors) + 5 most recent of each
- `GET /admin/settings`, `PUT /admin/settings` — `{ email, phone, linkedin }`
- `PUT /admin/security/password` — `{ current_password, new_password, new_password_confirmation }`
- `GET /admin/visitors` — visits grouped by IP (count, first/last seen, last path/referrer/UA), paginated
- `GET /admin/talent-applications` (`?status=`, `?search=`), `GET /admin/talent-applications/{id}`, `PATCH .../{id}` (`review_status`: new/contacted/shortlisted/rejected, `admin_notes`), `DELETE .../{id}`, `GET .../{id}/cv` (file download)
- `GET /admin/employer-requests` (`?status=`, `?search=`), `GET /admin/employer-requests/{id}`, `PATCH .../{id}` (`review_status`: new/contacted/in_progress/closed, `admin_notes`), `DELETE .../{id}`, `GET .../{id}/jd` (file download)

## Notes on data mapping

- The frontend's `status` field (professional status, e.g. "Recent Graduate") is stored as `professional_status` in the `talent_applications` table, since `status`/`review_status` here means the admin's own review workflow (new/contacted/shortlisted/rejected) — different concept, same-ish name, kept apart deliberately.
- Uploaded CVs and job descriptions are stored on the private `local` disk (`storage/app/private/...`), not publicly accessible — they can only be fetched via the authenticated download routes above.
- `skills`, `support_types`, `talent_areas`, and `help_needed` are stored as JSON columns and returned as arrays.

## What's not built yet

- The frontend doesn't call `/track-visit` yet — add that instrumentation when ready.
- No admin-facing UI — this is the API only. The Nuxt admin interface is separate, upcoming work.
