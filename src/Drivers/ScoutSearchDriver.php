<?php

declare(strict_types=1);

namespace Dskripchenko\LaravelAdminSearch\Drivers;

/**
 * Goes through Laravel\Scout::search(). It engages when the host has
 * laravel/scout installed and the resources' models use the
 * `Laravel\Scout\Searchable` trait.
 *
 * The fields are ignored — Scout decides what to index itself, from
 * model::toSearchableArray().
 */
final class ScoutSearchDriver implements SearchDriver
{
    public function search(string $modelClass, array $fields, string $query, int $limit): array
    {
        if (! class_exists($modelClass)) {
            return [];
        }
        // Scout is not necessarily installed; we check for the trait.
        if (! method_exists($modelClass, 'search')) {
            return [];
        }

        $rows = $modelClass::search($query)->take($limit)->get();

        if (! is_iterable($rows)) {
            return [];
        }

        $result = [];
        foreach ($rows as $row) {
            $result[] = is_object($row) && method_exists($row, 'toArray')
                ? $row->toArray()
                : (array) $row;
        }

        return $result;
    }
}
