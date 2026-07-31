# Mega Pharma Group — Website & Backend

A single Laravel application that serves the public Mega Pharma Group site (the
immersive one-page experience, with its 129-product catalogue and contact form
backed by MySQL) and an admin panel for managing products and contact
enquiries. There is no separate frontend/backend — Laravel serves everything.

## Stack

- Laravel 12, PHP 8.2+
- MySQL
- Blade views (public site is a single view: `resources/views/home.blade.php`)
- Laravel Breeze (Blade + Tailwind) for admin authentication

## Local setup

1. Copy `.env.example` to `.env` and set your MySQL connection
   (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`, `DB_HOST`, `DB_PORT`).
2. Create the database, e.g.:
   ```sql
   CREATE DATABASE mega_pharma CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```
3. Install dependencies:
   ```sh
   composer install
   npm install
   ```
4. Generate an app key (skip if `.env` already has one):
   ```sh
   php artisan key:generate
   ```
5. Run migrations and seed the database (creates the admin user and all 129
   products):
   ```sh
   php artisan migrate --seed
   ```
6. Build front-end assets (Tailwind, used only by the `/admin` panel):
   ```sh
   npm run build      # or: npm run dev
   ```
7. Serve the app:
   ```sh
   php artisan serve
   ```
   Visit `http://127.0.0.1:8000` for the public site.

## Running the dev server (this machine)

This machine has two MySQL installs: a standalone **MySQL80** Windows service
on the default port 3306 (its root password is unknown), and **XAMPP's**
bundled MySQL, which this project actually uses. To avoid the conflict,
XAMPP's MySQL was moved to port **3307** by editing the `port=` lines in
`C:\xampp\mysql\bin\my.ini`. `.env` already points at `127.0.0.1:3307`.

**1. Start MySQL** — open the **XAMPP Control Panel** and click **Start**
next to MySQL (it'll come up on port 3307 automatically), or from a
terminal:

```powershell
& "C:\xampp\mysql\bin\mysqld.exe" --defaults-file="C:\xampp\mysql\bin\my.ini" --standalone
```

**2. Start Laravel** — from the project folder:

```powershell
php artisan serve
```

Then visit `http://127.0.0.1:8000`. `php` resolves to `C:\xampp\php\php.exe`,
which is already on PATH, so no full path is needed. Stop either process
with `Ctrl+C` in its terminal.

If you ever want MySQL back on the default port 3306, change the two
`port=3307` lines in `C:\xampp\mysql\bin\my.ini` back to `3306` — but only
if the `MySQL80` Windows service isn't running, since it already owns that
port.

## Production deployment

Live at `http://178.128.124.43` (DigitalOcean droplet, Docker Compose — no
domain/HTTPS yet).

- **Pipeline**: every push to `main` runs `.github/workflows/deploy.yml`,
  which builds the `app` (PHP-FPM) and `nginx` images from the root
  `Dockerfile`, pushes them to GHCR (`ghcr.io/charmthiekshanaperera/mega-pharma-website-{app,nginx}`,
  public), then SSHes into the droplet to `docker compose pull && up -d` and
  run `php artisan migrate --force`. It deliberately never runs `db:seed` —
  `ProductSeeder` truncates the `products` table, which would wipe anything
  added via `/admin/products` in production.
- **Droplet layout**: `/opt/mega-pharma/docker-compose.yml` (kept in sync by
  the pipeline) + `/opt/mega-pharma/.env` (hand-written on the droplet only,
  holds `APP_KEY`/DB credentials, never committed).
- **Services**: `nginx` (public :80) → `app` (PHP-FPM) + `queue`
  (`artisan queue:work`) → `db` (MySQL 8.4, internal network only, named
  volume). `storage/` is a named volume so uploads/logs survive redeploys.
- **CI secrets** (`gh secret list`): `DEPLOY_HOST`, `DEPLOY_USER`,
  `DEPLOY_SSH_KEY` — the latter is a dedicated ed25519 keypair generated
  just for Actions, appended to the droplet's `authorized_keys`; it is not
  the same key used for interactive SSH access.
- **Follow-up not yet done**: point a real domain at the droplet and add
  Let's Encrypt/Certbot for HTTPS.

## Admin panel

- URL: `/admin` (redirects to `/login` if not authenticated)
- Seeded credentials: `admin@megapharma.lk` / `MegaPharma@2026`
  **Change this password after first login** (Profile page, top right).
- Public self-registration is disabled — create further admin users via
  `php artisan tinker` or a new seeder, setting `is_admin` to `true`.
- Manage products (`/admin/products`) and view/reply to contact-form
  enquiries (`/admin/messages`).

## How the pieces fit together

- `app/Http/Controllers/HomeController.php` — loads all products from MySQL
  and renders `resources/views/home.blade.php`, injecting them as
  `const PRODUCTS = @json($products)` so the existing client-side search/
  filter/3D engine works unmodified.
- `app/Http/Controllers/ContactMessageController.php` — handles the public
  contact form's `POST /contact`, storing enquiries in `contact_messages`
  (with a honeypot field to silently drop bot submissions).
- `app/Http/Controllers/Admin/*` — the admin CRUD for products and the
  contact-message inbox, gated by the `auth` + `admin` middleware
  (`app/Http/Middleware/EnsureUserIsAdmin.php`).
- `database/seeders/ProductSeeder.php` — seeds `products` from
  `database/seeders/data/products.json`, extracted from the original static
  product catalogue.
