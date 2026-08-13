<?php

declare(strict_types=1);

namespace Dskripchenko\LaravelAdminSearch\Concerns;

/**
 * A trait for the resources that should take part in the global search.
 *
 * It is used inside a resource:
 *
 *     class UserResource extends Resource {
 *         use Searchable;
 *         public function searchableFields(): array { return ['name', 'email']; }
 *         public function searchTitle(): string { return 'name'; }
 *     }
 *
 * Every method of the trait has a sane default — a resource overrides only the
 * ones it needs.
 */
trait Searchable
{
    /**
     * The fields for the LIKE/Scout search. It duplicates
     * Resource::searchableFields(), but the trait wins (a search usually needs a
     * wider set of fields).
     *
     * @return list<string>
     */
    abstract public function searchableFields(): array;

    /**
     * The name of the field shown as the title in a result (by default
     * 'name'/'title'/'id', tried in that order).
     */
    public function searchTitle(): string
    {
        return 'name';
    }

    /**
     * The name of the field for the subtitle (the small explanation — usually an
     * email, a slug and the like). null means no subtitle is shown.
     */
    public function searchSubtitle(): ?string
    {
        return null;
    }

    /**
     * The Lucide icon name for the group. Taken from Resource::$icon by default.
     */
    public function searchIcon(): ?string
    {
        /* @phpstan-ignore property.notFound */
        return static::$icon ?? 'circle';
    }

    /**
     * The URL or route of a selected result. By default the resource's edit
     * page.
     *
     * @param  array<string, mixed>  $row
     */
    public function searchUrl(array $row): string
    {
        $id = $row['id'] ?? null;
        if ($id === null) {
            return '';
        }
        $slug = static::slug();

        return "/admin/r/$slug/$id/edit";
    }

    /**
     * The priority in the output (the higher, the earlier). 0 by default.
     */
    public function searchPriority(): int
    {
        return 0;
    }
}
