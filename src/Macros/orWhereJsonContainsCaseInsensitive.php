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
Builder::macro('orWhereJsonContainsCaseInsensitive', function (string $column, $node, $value, $not = false) {
    return $this->whereJsonContainsCaseInsensitive($column, $node, $value, $not, true);
});