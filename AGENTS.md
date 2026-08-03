# AGENTS.md
### Project: PT. Berkah Makmur Transport — Logistic Express
Company Profile & CMS Website

This file is the operating manual for any AI coding agent (Claude Code, Copilot Workspace, Cursor, etc.) working on this repository. Read it fully before writing any code. Follow it literally — the constraints below (no Vite, no React, specific color system, no generic AI-looking UI) are hard requirements, not suggestions.

---

## 1. Project Summary

A corporate profile + blog + light CMS website for **PT. Berkah Makmur Transport**, an Indonesian logistics/freight/trucking company. The site must feel premium, industrial, and trustworthy — not like a templated SaaS landing page. It needs smooth-scroll storytelling (Lenis + GSAP + parallax), a small admin panel for non-technical staff to edit content, and strong SEO/performance since this is a lead-generation site for a logistics business.

**Brand identity:** Cream, Red, Yellow — warm industrial/transport palette with a cream dominant base (think premium logistics branding, freight containers, road signage), NOT a tech-startup palette (no purple/blue gradients, no glassmorphism, no generic SaaS look).

---

## 2. Hard Technical Constraints (DO NOT DEVIATE)

| Concern | Requirement |
|---|---|
| Framework | **Laravel 13** (latest LTS-style release) |
| Database | **MySQL** (InnoDB, utf8mb4) |
| Frontend build | **NO Vite. NO React. NO Node build pipeline as a runtime dependency.** |
| CSS | **Tailwind CSS**, compiled via **Tailwind Standalone CLI** (no Node/npm required to run in production) — see §4 |
| JS | Vanilla JS / ES modules loaded via `<script>` tags. Libraries self-hosted in `public/vendor/` (not CDN-only, for performance + offline reliability + no third-party tracking) |
| Animation | **GSAP** (+ ScrollTrigger plugin) for scroll animation, **Lenis** for smooth scrolling, custom parallax layers |
| Responsiveness | Fully mobile responsive, mobile-first Tailwind breakpoints |
| WYSIWYG editor | Open-source only, self-hosted, no API key / no cloud license — see §7 |
| Auth | Laravel's built-in auth scaffolding (manual controllers or Laravel Fortify — **not Breeze's Vite-based stack**, since Breeze ships with Vite by default). Build auth views by hand using Tailwind. |
| Asset pipeline | Everything must run without `npm run dev`/`npm run build` as a request-time dependency. Node is allowed only as a **one-time build step** to generate the Tailwind CSS output file, which is then committed/deployed as a static asset. |

### Why no Vite/React
The client wants a lightweight, easy-to-deploy site on standard shared/VPS Laravel hosting without a Node runtime in production, and wants full control over hand-tuned vanilla JS animations rather than a component framework's overhead.

---

## 3. Design Philosophy — "No AI Slop" Rules

The single biggest risk on this project is producing a generic-looking AI-generated website. Explicitly avoid:

- ❌ Purple/blue gradient hero sections
- ❌ Generic rounded-corner cards with drop shadows everywhere ("SaaS landing page" look)
- ❌ Default Google Fonts pairing of Inter + Poppins with no personality
- ❾ Centered hero + 3 generic icon-boxes + generic "Our Services" grid with Heroicons
- ❌ Stock photography of random smiling business people / generic handshake photos
- ❌ Emoji used as icons
- ❌ Symmetrical, safe, centered-everything layouts with no visual tension
- ❌ Lorem-ipsum feeling copy blocks with no local/industry specificity

Instead, build toward:

- ✅ **Industrial/transport visual language**: diagonal cuts (clip-path), warning-stripe accents (cream/yellow diagonal bands), asphalt/route-line textures, container-yard grid motifs, custom truck/route SVG illustrations (not stock icon packs).
- ✅ **Typography with character**: pair a bold condensed/industrial display face (e.g. self-hosted "Archivo Black", "Bebas Neue", or "Oswald") for headings with a clean readable body face (e.g. "Inter" or "Public Sans") — self-hosted, not loaded from Google Fonts CDN (performance + no external request).
- ✅ **Asymmetric grid layouts**, overlapping image + content blocks, offset section dividers using SVG clip-paths shaped like road markings or container edges.
- ✅ **Parallax storytelling**: hero background layers (road, horizon, truck silhouette) moving at different scroll speeds via GSAP + Lenis.
- ✅ **Motion with restraint**: entrance animations on scroll (fade+slide, clip reveal), not everything spinning/bouncing.
- ✅ **Color discipline**: Cream as dominant base (backgrounds, headers, footer), Red as primary CTA/accent (buttons, links, highlights, active states), Yellow as secondary accent (small highlights, underlines, icon accents, hazard-stripe details) — never all three competing in one element.

Example palette (agent may refine but must stay within this family):

```
--color-cream:         #F5F0E8   /* warm cream, primary base */
--color-cream-light:   #FAF7F2   /* lighter cream for headers/hero */
--color-red:           #D62828   /* primary CTA / brand red */
--color-red-dark:      #A31E1E
--color-yellow:        #F4C430   /* accent yellow, road-sign yellow, not neon */
--color-yellow-dark:   #C79A1E
--color-dark:          #1C1917   /* dark text, near-black for contrast */
--color-gray:          #6B6E73
```

---

## 4. Tailwind CSS Setup (No Vite)

Use the Tailwind CSS **Standalone CLI binary** so the build has zero Node/npm runtime dependency:

```bash
# One-time setup (dev machine / CI build step only)
curl -sLO https://github.com/tailwindlabs/tailwindcss/releases/latest/download/tailwindcss-linux-x64
chmod +x tailwindcss-linux-x64
mv tailwindcss-linux-x64 tailwindcss

# Build command (add to a Makefile or composer script)
./tailwindcss -i ./resources/css/app.css -o ./public/css/app.css --minify
```

- Source: `resources/css/app.css` (contains `@tailwind base; @tailwind components; @tailwind utilities;` + custom brand utility classes)
- Config: `tailwind.config.js` at project root, `content` paths pointing to `resources/views/**/*.blade.php`
- Output committed to `public/css/app.css` and referenced directly via `<link>` in the Blade layout — **no `@vite()` directive anywhere**.
- Add a composer script alias so agents/devs can run `composer run build-css`.

---

## 5. Animation Stack

Self-host these libraries in `public/vendor/` (download once, commit, or fetch during deploy — do not depend on a CDN at runtime for reliability):

- **Lenis** (smooth scroll) — `public/vendor/lenis/lenis.min.js`
- **GSAP core + ScrollTrigger** — `public/vendor/gsap/gsap.min.js`, `public/vendor/gsap/ScrollTrigger.min.js`

Integration pattern (`resources/js/app.js`, compiled/copied as-is to `public/js/app.js` — plain JS, no bundler needed, use ES module `<script type="module">` or plain script + IIFE):

```js
// public/js/app.js
const lenis = new Lenis({ duration: 1.1, smoothWheel: true });
function raf(time) { lenis.raf(time); requestAnimationFrame(raf); }
requestAnimationFrame(raf);

gsap.registerPlugin(ScrollTrigger);
lenis.on('scroll', ScrollTrigger.update);
gsap.ticker.add((time) => lenis.raf(time * 1000));
gsap.ticker.lagSmoothing(0);

// Example parallax layer
gsap.to('.parallax-layer-back', {
  yPercent: -20,
  ease: 'none',
  scrollTrigger: { trigger: '.hero', start: 'top top', end: 'bottom top', scrub: true }
});
```

Guidelines:
- Respect `prefers-reduced-motion` — disable Lenis smoothing and GSAP scroll animations for users who request it.
- Keep parallax subtle (10–30% offset), never causing layout shift or blocking content.
- Lazy-init animations only on viewport entry (`ScrollTrigger` handles this natively) to avoid wasted work.

---

## 6. Site Map / Pages

| # | Page (ID) | Route name | Notes |
|---|---|---|---|
| 1 | Beranda | `home` | Hero w/ parallax, company highlights, service teaser, stats counter, testimonials, latest articles, CTA |
| 2 | Layanan (dropdown, 3 items) | `layanan.index`, plus 3 sub-pages | See §6.1 |
| 3 | Tentang Kami | `about` | Company history, vision/mission, legal info, fleet, team, certifications |
| 4 | Galeri | `gallery` | Filterable image/video gallery (fleet, warehouse, operations), lightbox |
| 5 | Hubungi Kami | `contact` | Contact form (stored to DB + optional email), map embed, branch list |
| 6 | Artikel | `articles.index`, `articles.show` | Blog/news listing + detail, categories, tags, search |
| 7 | Login Admin | `admin.login` | Separate auth guard `admin`, styled distinctly from public site |
| 8 | Dashboard Admin | `admin.dashboard` | Overview widgets: messages count, articles count, gallery count, latest activity |
| 9 | CMS Menu (admin) | `admin.*` | See §6.2 |

### 6.1 Layanan Dropdown — 3 Services (default content, editable via CMS)

Suggested default services (agent should confirm with client but implement structure to support any 3 via DB, not hardcoded):

1. **Pengiriman Darat (Trucking / Land Freight)** — `layanan.darat`
2. **Pengiriman Laut (Sea Freight)** — `layanan.laut`
3. **Pengiriman Udara (Air Freight)** — `layanan.udara`

Each service page: hero banner, description (rich text from CMS), coverage area, fleet/equipment used, process steps (icons), related articles, CTA to contact.

> Implementation note: Services must be a **database-driven** resource (`services` table), not hardcoded Blade partials, so admin can add/edit/reorder/rename without a code deploy. The nav dropdown is generated dynamically from active services (limit configurable, default top 3 shown in nav).

### 6.2 Admin CMS Menu Structure

```
Dashboard
├── Konten Halaman (Pages)         → edit Beranda hero text, Tentang Kami content, Kontak info
├── Layanan (Services)             → CRUD: title, slug, icon, excerpt, rich-text body, image, order, status
├── Artikel (Articles)
│   ├── Semua Artikel              → CRUD, WYSIWYG body, featured image, SEO fields, status (draft/published), scheduled publish
│   └── Kategori & Tag
├── Galeri (Gallery)                → CRUD image/video, category, caption, order
├── Testimoni (Testimonials)        → CRUD name, company, photo, quote, rating
├── Pesan Masuk (Contact Messages)  → inbox of contact form submissions, mark read/replied, export
├── Tim / Struktur (Team)           → CRUD member: name, position, photo, bio, social links
├── Pengaturan (Settings)           → site name, logo, favicon, address(es), phone/WA, email, social links,
│                                       Google Maps embed, SEO defaults (meta title/desc/OG image), Google Analytics/Tag Manager ID
├── Pengguna Admin (Admin Users)     → CRUD admin accounts, roles (Super Admin, Editor)
└── Log Aktivitas (Activity Log)     → who changed what, when (optional, nice-to-have)
```

---

## 7. WYSIWYG Editor (Open Source)

Use **one** of the following, self-hosted (no cloud API key, no paid license):

- **Preferred: Quill.js** — lightweight, MIT-licensed, easy to theme to match brand, no server dependency. Good for article body + service description fields.
- **Alternative: TinyMCE (self-hosted, GPL/Community build)** — richer toolbar, table support, if client needs more advanced formatting (embeds, tables). Must download and self-host the community build (`tinymce-community`), NOT the cloud CDN key version.
- **Alternative: CKEditor 5 (open-source build)** via classic editor build, self-hosted.

Recommendation for this project: **Quill.js**, self-hosted at `public/vendor/quill/`, since content needs (article body, service descriptions, about-us text) are straightforward rich text — no need for TinyMCE's heavier footprint. Store output as sanitized HTML (use `mews/purifier` or similar HTML Purifier package server-side before saving to DB to prevent stored XSS).

---

## 8. Database Schema (MySQL) — Core Tables

```
users                — admin accounts (guard: admin) — id, name, email, password, role (enum: super_admin, editor), avatar, timestamps
services             — id, title, slug, icon, excerpt, body (longtext), image, order, is_active, seo_title, seo_description, timestamps
articles             — id, category_id, title, slug, excerpt, body (longtext), featured_image, author_id, status (draft/published), published_at, seo_title, seo_description, views, timestamps
article_categories    — id, name, slug, timestamps
article_tags          — id, name, slug
article_tag           — pivot (article_id, tag_id)
gallery_items         — id, title, type (image/video), file_path, thumbnail, category, order, is_active, timestamps
testimonials          — id, name, company, photo, quote, rating, is_active, order, timestamps
team_members          — id, name, position, photo, bio, socials (json), order, is_active, timestamps
contact_messages      — id, name, email, phone, subject, message, is_read, replied_at, timestamps
site_settings          — key (string, unique), value (text/json)  — single-row/key-value config store
pages                  — id, slug (unique: 'beranda', 'tentang-kami', etc.), sections (json) or per-field columns for hero/content blocks
activity_logs          — id, user_id, action, subject_type, subject_id, description, timestamps  (optional)
```

Indexing: add indexes on `slug` columns, `status`, `published_at`, `is_active`, foreign keys. Use Laravel migrations + model factories/seeders for demo content.

---

## 9. SEO Requirements

- Semantic HTML5 (`<header>`, `<nav>`, `<main>`, `<article>`, `<footer>`, one `<h1>` per page, logical heading hierarchy).
- Per-page dynamic `<title>` and `<meta name="description">` driven by CMS fields (`seo_title`, `seo_description`), with sensible fallbacks from `site_settings`.
- Open Graph + Twitter Card meta tags on every public page (og:title, og:description, og:image, og:type, og:url).
- `schema.org` JSON-LD structured data: `LocalBusiness`/`Organization` on Beranda + Tentang Kami/Kontak, `Article` schema on article detail pages, `BreadcrumbList` site-wide.
- Auto-generated `sitemap.xml` (route + command, e.g. `php artisan sitemap:generate` scheduled) covering static pages, services, published articles, gallery categories.
- `robots.txt` allowing crawl of public pages, disallowing `/admin`.
- Canonical URLs (`<link rel="canonical">`) on every page.
- Descriptive `alt` text on all images (from CMS `alt_text` field, required on upload).
- Clean, human-readable slugs everywhere (auto-generate from title, editable).
- Fast Core Web Vitals (see §10) — SEO and performance are tightly linked for Google ranking.

---

## 10. Performance Optimization Checklist

- **Images**: convert uploads to WebP (server-side via Intervention Image), generate responsive sizes (`srcset`), lazy-load with native `loading="lazy"` except hero/LCP image.
- **Fonts**: self-host, use `font-display: swap`, preload the primary heading + body font files.
- **CSS/JS**: single minified Tailwind output file; vendor JS (GSAP/Lenis) minified, deferred/loaded with `defer`; avoid render-blocking scripts in `<head>`.
- **Caching**: `php artisan config:cache`, `route:cache`, `view:cache` in production; HTTP cache headers / `Cache-Control` on static assets; consider `spatie/laravel-responsecache` for public pages.
- **Database**: eager-load relationships (avoid N+1), paginate article/gallery listings, add indexes per §8, use query caching for rarely-changing content (services, settings).
- **CDN/Edge**: static assets served with far-future cache headers + versioned filenames (cache busting via a simple `filemtime()`-based query string since there's no Vite manifest).
- **Critical rendering path**: inline a small critical CSS snippet for above-the-fold hero if measurements show benefit; defer the rest.
- **Monitoring**: target Lighthouse Performance/SEO/Accessibility/Best Practices scores ≥ 90.

---

## 11. Folder Structure (Key Additions to Default Laravel 13 Layout)

```
app/
  Http/Controllers/
    Public/            (HomeController, ServiceController, AboutController, GalleryController, ContactController, ArticleController)
    Admin/             (DashboardController, ServiceCrudController, ArticleCrudController, GalleryCrudController, ...)
    Auth/AdminAuthController
  Models/               (Service, Article, ArticleCategory, ArticleTag, GalleryItem, Testimonial, TeamMember, ContactMessage, SiteSetting, Page)
  Http/Middleware/      (AdminAuth, EnsureAdminRole)
config/
  tailwind (n/a - CLI based, config at root)
resources/
  css/app.css
  views/
    layouts/            (app.blade.php public layout, admin.blade.php admin layout)
    partials/           (navbar with dropdown, footer, hero, seo-meta, parallax sections)
    home/, services/, about/, gallery/, contact/, articles/
    admin/              (dashboard, services, articles, gallery, testimonials, team, messages, settings, users)
    auth/admin-login.blade.php
public/
  css/app.css            (compiled Tailwind output — committed)
  js/app.js              (hand-written vanilla JS + GSAP/Lenis init)
  vendor/gsap/, vendor/lenis/, vendor/quill/
  images/
database/
  migrations/, seeders/, factories/
routes/
  web.php                (public routes)
  admin.php              (admin routes, prefix 'admin', middleware ['auth:admin'])
tailwind.config.js
```

---

## 12. Auth & Roles

- Separate guard `admin` (own `admins` or `users` table with `role` column) distinct from any future customer-facing auth.
- Admin login page styled on-brand (cream/red/yellow), NOT the default Laravel Breeze scaffold look.
- Roles: `super_admin` (full CMS access incl. user management/settings) and `editor` (content only: services, articles, gallery, testimonials, messages — no settings/user management).
- Rate-limit login attempts, CSRF protection on all forms (Laravel default), sanitize all rich-text input server-side before persisting.

---

## 13. Coding Conventions

- PSR-12, Laravel naming conventions (singular Model, plural table, resource controllers where sensible).
- Use Form Request classes for validation (`StoreArticleRequest`, `UpdateServiceRequest`, etc.).
- Use Laravel Policies for admin role-based authorization.
- Blade components (`<x-...>`) for repeated UI: buttons, section headers, cards, breadcrumb, SEO meta partial — keep markup DRY without needing a JS framework.
- All admin CRUD screens: consistent table + filter + pagination pattern; confirm-before-delete modals (vanilla JS, no Alpine/Livewire required, though **Alpine.js is allowed** as a lightweight sprinkle for UI interactivity like dropdowns/modals since it has no build step — GSAP/Lenis remain the animation layer).
- Write feature tests for critical paths: contact form submission, article CRUD, admin auth, service CRUD.

---

## 14. Definition of Done (per page/feature)

A page/feature is complete only when it:
1. Matches the cream/red/yellow industrial brand direction, not a generic template look.
2. Is fully responsive (tested at 375px, 768px, 1024px, 1440px).
3. Has working Lenis smooth scroll + at least one intentional GSAP scroll/parallax moment (where appropriate — not forced on every page).
4. Has correct SEO meta (title, description, OG, canonical, schema where applicable).
5. Loads with no console errors, no layout shift, images lazy-loaded and optimized.
6. If content-bearing, is editable through the admin CMS (no hardcoded copy that should be dynamic).
7. Passes basic accessibility checks (color contrast against cream background, alt text, keyboard-navigable nav/dropdown).

---

## 15. Security Requirements

Security is not optional/"nice to have" — treat every item below as part of Definition of Done for the relevant feature.

### 15.1 SQL Injection Prevention

- **Never build raw SQL by string concatenation.** Use Eloquent ORM or the Query Builder exclusively; both parameter-bind automatically.
- If a raw query is unavoidable (rare — e.g. a complex report), use parameter binding, never interpolate variables directly:
  ```php
  // ❌ NEVER
  DB::select("SELECT * FROM articles WHERE slug = '$slug'");

  // ✅ ALWAYS
  DB::select('SELECT * FROM articles WHERE slug = ?', [$slug]);
  // or, preferred, use Eloquent:
  Article::where('slug', $slug)->first();
  ```
- Never pass user input into `DB::raw()`, `whereRaw()`, `orderByRaw()`, `selectRaw()` without binding. If dynamic column/table names are needed (e.g. dynamic sort field from a query string), **whitelist against an allowed-values array** — never trust the raw input as an identifier:
  ```php
  $allowedSorts = ['title', 'published_at', 'views'];
  $sort = in_array($request->query('sort'), $allowedSorts) ? $request->query('sort') : 'published_at';
  ```
- All search/filter features (article search, gallery filter, admin table search) must use `where(...)->orWhere(...)` or `whereLike` with bound parameters — never raw LIKE string concatenation.
- Enforce strict typing/validation on all route parameters and query strings via Form Requests before they reach any query.
- Use MySQL user accounts with least-privilege: the app's DB user should not have `DROP`/`GRANT` privileges in production; migrations run under a separate deploy-time credential if possible.

### 15.2 Cross-Site Scripting (XSS)

- Blade's `{{ }}` auto-escapes output — **never use `{!! !!}` on user-submitted content** except for sanitized WYSIWYG HTML (see below).
- All rich-text content from Quill/TinyMCE (articles, service descriptions, page sections) must be passed through an HTML Purifier (e.g. `mews/purifier`) server-side on save, with a strict allowed-tags/attributes whitelist (no `<script>`, no inline `on*` event handlers, no `javascript:` URLs).
- Sanitize/escape any user input reflected back into the page (contact form confirmation, search query echoed on results page).
- Set a `Content-Security-Policy` header restricting script sources to self + explicitly trusted origins (no `unsafe-inline` for scripts where avoidable; if inline scripts are needed for GSAP init, use a nonce).

### 15.3 CSRF & Session

- Keep Laravel's default CSRF middleware active on all state-changing routes (`@csrf` in every form: contact form, admin CRUD forms, login).
- Admin session cookies: `HttpOnly`, `Secure` (HTTPS only in production), `SameSite=Lax` or `Strict`.
- Regenerate session ID on login (`session()->regenerate()`) to prevent session fixation.
- Set reasonable session lifetime + idle timeout for the admin guard.

### 15.4 Authentication & Authorization

- Passwords hashed via Laravel's default `bcrypt`/`Hash` facade — never store plaintext or use weak hashing.
- Enforce a minimum password policy on admin account creation (length, not a common password — use `Password::min(10)->uncompromised()` rule).
- Rate-limit login attempts (`throttle` middleware, e.g. 5 attempts / minute) and lock out with backoff on repeated failures.
- All `/admin/*` routes protected by `auth:admin` middleware; additionally enforce role checks via Policies/Gates so an `editor` cannot reach `super_admin`-only actions (settings, user management) even by guessing a URL.
- Never trust client-side role checks alone — always re-verify authorization server-side on every admin controller action.
- Log out admin sessions on password change; support session invalidation.

### 15.5 File Upload Security (Gallery, Article Images, Avatars)

- Validate uploads by **actual MIME type/content inspection**, not just file extension (Laravel's `image` validation rule + `mimes:jpg,jpeg,png,webp` + max file size).
- Re-encode/re-process all uploaded images server-side (via Intervention Image) rather than storing the raw uploaded file as-is — this strips embedded scripts/metadata and normalizes format.
- Store uploads outside of directly-executable paths, or ensure the storage disk serves files without PHP execution (standard `storage/app/public` symlinked to `public/storage` is fine since it's not PHP-executable, but never allow upload into `public/` root or any path where `.php` execution is possible).
- Generate randomized/hashed filenames on save (don't trust the original filename) to avoid path traversal or overwrite attacks.
- Enforce max upload size at both PHP (`upload_max_filesize`, `post_max_size`) and Laravel validation level.

### 15.6 General Hardening

- `APP_DEBUG=false` and `APP_ENV=production` in production — never leak stack traces/queries to end users.
- Enforce HTTPS site-wide (redirect HTTP→HTTPS, HSTS header).
- Set security headers: `X-Content-Type-Options: nosniff`, `X-Frame-Options: DENY` (or `SAMEORIGIN` if embeds are needed), `Referrer-Policy: strict-origin-when-cross-origin`, `Permissions-Policy` restricting unused browser features.
- Keep Laravel core + all Composer/NPM dependencies up to date; run `composer audit` periodically for known CVEs.
- Contact form and any public input endpoints: add basic spam protection (honeypot field and/or rate limiting) in addition to CSRF, since this is a public lead-gen form.
- Mass-assignment protection: explicit `$fillable` (not `$guarded = []`) on every Eloquent model.
- Disable directory listing on the web server; ensure `.env`, `.git`, `storage/`, and `composer.json` are not publicly accessible (default Laravel `public/` document root already handles this — verify server vhost config matches).
- Backups: automated MySQL backups (e.g. `spatie/laravel-backup`) with off-server storage, tested restore procedure.
- Log security-relevant events (failed logins, admin content changes) to `activity_logs` / Laravel log channel for auditability — do not log sensitive data (passwords, full session tokens).

---

## 16. Open Questions to Confirm With Client (agent should flag, not silently assume)

- Final wording/branding for the 3 Layanan services (defaults proposed in §6.1).
- Whether multi-branch locations are needed on Kontak/map.
- Whether articles need multi-author support or a single company voice.
- WhatsApp click-to-chat integration on Kontak/CTA buttons (common for Indonesian logistics sites) — confirm number(s).