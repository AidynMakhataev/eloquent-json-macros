<?php

use Illuminate\Database\Eloquent\Builder;
use AidynMakhataev\EloquentJsonMacros\EloquentJsonMacros;

/*
 * Add a "json_depth" select expression to the query.
 *
 * @param string $path
 * @param string $resultName
 *
 * @return Builder
 */
Builder::macro('selectJsonDepth', function ($path, $resultName = 'jsonResult') {
    $path = EloquentJsonMacros::prepareJsonPath($path);

    return $this->selectRaw("JSON_DEPTH($path) AS $resultName");
});
