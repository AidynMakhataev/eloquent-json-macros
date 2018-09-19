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
Builder::macro('whereJsonContainsPath', function (string $column, $path, string $oneOrAll = 'one') {
    if (is_array($path)) {
        foreach ($path as $key => $item) {
            $path[$key] = "'".EloquentJsonMacros::formatJsonPath($item)."'";
        }
        $path = implode(',', $path);
    } else {
        $path = "'".EloquentJsonMacros::formatJsonPath($path)."'";
    }

    return $this->whereRaw("JSON_CONTAINS_PATH($column, '$oneOrAll', $path)");
});
