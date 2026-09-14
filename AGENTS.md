# MadaTravel — règles pour agents (Claude Code, Codex, Grok)

Tu travailles sur **MadaTravel** : agence de **location de voitures** + **voyages** basée à Madagascar.

## Stack figée

- Laravel 13 / PHP 8.3+
- Filament 4 pour l’admin
- Inertia.js + Vue 3 + Tailwind pour le site public
- SQLite en local, PostgreSQL en prod
- Redis + queues en prod
- FR + EN (malgache plus tard)

Ne change pas la stack sans décision écrite dans `docs/PLAN.md`.

## Produit

1. Flotte (berline, 4x4, minibus) avec ou sans chauffeur-guide
2. Circuits / séjours (peuvent inclure véhicule + chauffeur)

Conversion MVP = demande de devis + WhatsApp.

## Règles

- Une feature = un ticket GitHub.
- Toute réservation confirmée bloque le véhicule.
- Montants en Ariary entier.
- Fuseau : Indian/Antananarivo.
- Pas de secrets dans le repo.

## Interdit en MVP

App mobile, paiement Mobile Money, compte client obligatoire, marketplace, recoder le Laravel 8.
