<?php

use Illuminate\Database\Eloquent\Builder;
use AidynMakhataev\EloquentJsonMacros\EloquentJsonMacros;

/*
 * Add a orWhere "json_contains" clause to the query.
 *
 * @param string $path
 * @param string $needle
 *
 * @return Builder
 */
Builder::macro('orJsonContains', function ($path, $needle) {
    $path = EloquentJsonMacros::prepareJsonPath($path);

    $needle = EloquentJsonMacros::formatNeedle($needle);

    return $this->orWhereRaw("JSON_CONTAINS($path, $needle)");
});
