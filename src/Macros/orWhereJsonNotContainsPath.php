<?php

use Illuminate\Database\Eloquent\Builder;
use AidynMakhataev\EloquentJsonMacros\EloquentJsonMacros;

/*
 * Add an orWhere "json_contains_path" clause to the query.
 *
 * @param string $column
 * @param mixed $path
 * @param string $oneOrAll
 *
 * @return Builder
 */
Builder::macro('orWhereJsonNotContainsPath', function ($column, $path, $oneOrAll = 'one') {
    return $this->orWhereJsonContainsPath($column, $path, $oneOrAll, true);
});
