<?php

use Illuminate\Database\Eloquent\Builder;
use AidynMakhataev\EloquentJsonMacros\EloquentJsonMacros;

/*
 * Add a where "json_depth" clause to the query.
 *
 * @param string $path
 * @param mixed  $operator
 * @param mixed  $value
 *
 * @return Builder
 */
Builder::macro('whereJsonDepth', function (string $path, $operator = null, $value = null) {
    $path = EloquentJsonMacros::prepareJsonPath($path);

    list($value, $operator) = $this->getQuery()->prepareValueAndOperator(
        $value, $operator, func_num_args() === 2
    );

    return $this->whereRaw("JSON_DEPTH($path) $operator :value", [
        'value' => $value
    ]);
});
