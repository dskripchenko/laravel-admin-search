> ## ⚠️ Пакет закрыт 17.08.2026
>
> Ядро реализовало глобальный поиск само (⌘K, core 1.10.5), и делает это аккуратнее: учитывает indexQuery ресурса, то есть soft-delete, слой тенанта и ограничения хоста. Хуже того, установленный пакет ПЕРЕКРЫВАЛ ядерный маршрут api/admin/system/search — витрина показывала версию слабее.
>
> Ставить его больше не нужно: всё, ради чего он заводился, есть в
> `dskripchenko/laravel-admin`. Установленным он не вредит, но и не добавляет
> ничего — кроме случая с поиском, где он ЗАМЕЩАЛ ядерный маршрут.

# dskripchenko/laravel-admin-search

> 🌐 **English** · [Русский](docs/ru/README.md) · [Deutsch](docs/de/README.md) · [中文](docs/zh/README.md)

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
