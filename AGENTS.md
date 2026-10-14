# AGENTS.md

Institutional website + admin CMS for ONG TAUF (Benin). Laravel 13, PHP 8.3+, SQLite, Vite + Tailwind CSS v4, Quill rich-text. Site content and routes are in French.

## Commands

- Setup from scratch: `composer setup` (installs PHP deps, copies `.env`, generates key, migrates, `npm install --ignore-scripts`, `npm run build`)
- Run tests: `composer test` (clears config cache first — stale `config:cached` breaks tests). Directly: `php artisan test`
- Single test: `php artisan test --filter=AdminPagesTest` or `php artisan test --filter="test_admin_can_login"`
- Format PHP: `vendor/bin/pint` (Laravel preset)
- Frontend: `npm run build` for production assets; `npm run dev` for HMR. Blade views use `@vite` — a missing `public/build/manifest.json` means assets were never built, not that Vite should run in prod.

## Architecture

- `routes/web.php` is the URL source of truth. Front-office routes are hand-written (French slugs, e.g. `/a-propos/{slug}`, `/programmes/{program}`); admin routes are `Route::resource(...)->except('show')` under `/admin`.
- Controllers: `app/Http/Controllers/Front\*` (public pages) and `app/Http/Controllers\Admin\*` (CMS). `app/Http/Controllers/Concerns\HandlesUploads.php` is the shared upload trait.
- Views: `resources/views/front/*`, `resources/views/admin/*`, shared form components in `resources/views/components/admin/*` (`x-admin.editor`, `x-admin.input`, …). Rich-text fields render via Quill on a `data-editor` div bound to a hidden `#<name>-input` textarea — keep that convention when adding fields.

## Settings system (easy to break)

- `Setting` model caches everything forever (`Cache::rememberForever('tauf_settings')`). After writing settings outside the admin controller (seeders, tinker), call `Setting::flush()`. The admin Settings controller flushes on update.
- `config/tauf.php` is the whitelist of settings editable in the back-office. A new setting key must be added to **both** `config/tauf.php` and `database/seeders/DatabaseSeeder.php`, or it will be silently rejected on save.
- Every view receives `$tauf` (all settings) via a view composer; use `tauf_setting('key')` helper. Other global helpers in `app/Support/helpers.php`: `upload_url()` (falls back to `images/placeholder.svg`), `french_date()`.

## Auth & roles

Roles on `users.role`: `super_admin`, `admin`, `editeur`, `contributeur`.
- `admin` middleware (`EnsureUserIsAdmin`): requires auth **and** `is_active`; inactive users are logged out with an error.
- `superadmin` middleware: `canManageUsers()` = `super_admin` or `admin` only — `editeur` gets 403 on user management.
- Login throttle: contact and newsletter POSTs are `throttle:10,1`.

## Content model

- `HasSlug` trait: auto-generates a unique slug on save from the `slugSource` attribute (defaults to `title`) — don't set slugs manually.
- `HasViews` trait: `recordView()` increments `views`; front detail pages call it.
- Never `deleteFile()` paths starting with `images/` or `build/` — those are committed seed/public assets, not uploads. Real uploads live on the `public` disk.

## Tests

- PHPUnit 12, in-memory SQLite (`phpunit.xml`), `RefreshDatabase`, seeded via `DatabaseSeeder` in `setUp()`.
- Seed credentials: `admin@ongtauf.org` / `password` (super_admin), `editeur@ongtauf.org` / `password` (editeur).
- Tests assert pages render `assertOk()` — when adding an admin CRUD view, mirror the existing pattern (`index`/`create`/`form.blade.php`) or `AdminPagesTest` data providers will fail.
- Content factories don't exist (only `UserFactory`); seed demo data through the seeder with `updateOrCreate`, never `factory()->create()` for content models.
