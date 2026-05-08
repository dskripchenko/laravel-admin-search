---
title: Usage
locale: en
status: stable
---

# Usage

```php
// config/admin-search.php
'driver' => 'eloquent',  // or 'scout'

'resources' => [
    \App\Admin\Resources\ArticleResource::class => [
        'searchable' => ['title', 'slug', 'excerpt'],
        'preview' => fn ($article) => $article->title,
    ],
],
```

```bash
# Index for Scout (if used):
php artisan scout:import 'App\Models\Article'
```

