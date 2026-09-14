# MadaTravel platform

Agence de location de voitures et voyages à Madagascar.

Repo : https://github.com/JohnXX32/madatravel-platform

## Local

```bash
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate --seed
php artisan serve
```

Lire `AGENTS.md`, `docs/PLAN.md`, `docs/DOMAIN.md`, `docs/CLAUDE-CODE-PROMPTS.md`.
