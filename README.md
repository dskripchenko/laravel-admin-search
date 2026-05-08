# dskripchenko/laravel-admin-search

> 🌐 **English** · [Русский](README.ru.md) · [Deutsch](README.de.md) · [中文](README.zh.md)

Global search (⌘K / Ctrl+K). Eloquent driver by default, Laravel Scout adapter optional.

A sister-pack for [`dskripchenko/laravel-admin`](https://github.com/dskripchenko/laravel-admin).

[![Packagist](https://img.shields.io/packagist/v/dskripchenko/laravel-admin-search)](https://packagist.org/packages/dskripchenko/laravel-admin-search)
[![License](https://img.shields.io/packagist/l/dskripchenko/laravel-admin-search)](LICENSE)

## Install

```bash
composer require dskripchenko/laravel-admin-search
php artisan migrate
```

The plugin auto-registers via Laravel package discovery. To publish the
config:

```bash
php artisan vendor:publish --tag=search-config
```

## Documentation

- [Getting started](docs/en/getting-started.md)
- [Usage](docs/en/usage.md)

## License

[MIT](LICENSE) © Denis Skripchenko
