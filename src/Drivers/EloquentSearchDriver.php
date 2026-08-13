<?php

declare(strict_types=1);

namespace Dskripchenko\LaravelAdminSearch\Drivers;

/**
 * A LIKE %query% over each of the searchable fields, with OR semantics.
 *
 * Suitable for projects up to about 100K rows in total. Larger tables need the
 * ScoutSearchDriver.
 */
final class EloquentSearchDriver implements SearchDriver
{
    public function search(string $modelClass, array $fields, string $query, int $limit): array
    {
        if (! class_exists($modelClass)) {
            return [];
        }
        if ($fields === []) {
            return [];
        }

        $instance = new $modelClass;
        $builder = $instance->newQuery();

        $like = '%'.$query.'%';
        $builder->where(function ($q) use ($fields, $like): void {
            foreach ($fields as $field) {
                $q->orWhere($field, 'LIKE', $like);
            }
        });

        $rows = $builder->limit($limit)->get();

        return $rows->map(fn ($r) => $r->toArray())->all();
    }
}
