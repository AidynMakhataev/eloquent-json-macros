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
Builder::macro('whereJsonContainsCaseInsensitive', function (string $column, $node, $value, $not = false, $or = false, $start = false) {
    return $this->{($or?'orWhereRaw':'whereRaw')}(($not)?"NOT ":""."JSON_CONTAINS(LOWER(CAST(JSON_EXTRACT($column, '$".($start?'."'.$start.'"':null)."' ) AS CHAR)), LOWER('{\"$node\": \"$value\"}'))");
});