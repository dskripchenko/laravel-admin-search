---
title: Getting Started
locale: en
status: stable
---

# Getting Started

`dskripchenko/laravel-admin-search` is a sister-pack of `dskripchenko/laravel-admin`.
Install once — it auto-registers and surfaces in your admin.

## Install

```bash
composer require dskripchenko/laravel-admin-search
php artisan migrate
```

## Configure

```bash
php artisan vendor:publish --tag=search-config
```

Edit `config/search.php`.


## What it adds

`⌘K` / `Ctrl+K` opens the global command palette anywhere in the
admin. Searches across all registered Resources by default
(`searchableFields()`).

Drivers:

- **eloquent** (default) — `LIKE %q%` over each Resource's
  `searchableFields()`. Good up to ~1M rows total.
- **scout** — Laravel Scout adapter (Algolia / Meilisearch / database
  scout). Use for >1M or when full-text relevance matters.

## See also

- [Usage](usage.md)
- [Glossary](https://github.com/dskripchenko/laravel-admin/blob/main/docs/en/glossary.md)
