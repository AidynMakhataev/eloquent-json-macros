<?php

use Illuminate\Database\Eloquent\Builder;
use AidynMakhataev\EloquentJsonMacros\EloquentJsonMacros;

/*
 * Add a where "json_contains" clause to the query.
 *
 * @param string $path
 * @param string $needle
 *
 * @return Builder
 */
Builder::macro('jsonContains', function ($path, $needle) {
    $path = EloquentJsonMacros::prepareJsonPath($path);

    $needle = EloquentJsonMacros::formatNeedle($needle);

    return $this->whereRaw("JSON_CONTAINS($path, $needle)");
});
