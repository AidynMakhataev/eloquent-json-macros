<?php

use Illuminate\Database\Eloquent\Builder;
use AidynMakhataev\EloquentJsonMacros\EloquentJsonMacros;

/*
 * Add a where "json_contains_path" clause to the query.
 *
 * @param string $column
 * @param mixed $path
 * @param string $oneOrAll
 *
 * @return Builder
 */
Builder::macro('whereJsonNotContainsPath', function (string $column, $path, string $oneOrAll = 'one') {
    return $this->whereJsonContainsPath($column, $path, $oneOrAll = 'one', true);
});
