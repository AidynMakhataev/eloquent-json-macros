<?php

use Illuminate\Database\Eloquent\Builder;
use AidynMakhataev\EloquentJsonMacros\EloquentJsonMacros;

/*
 * Add an orWhere "json_length" clause to the query.
 *
 * @param string $path
 * @param mixed  $operator
 * @param mixed  $value
 *
 * @return Builder
 */
Builder::macro('orWhereJsonLength', function ($path, $operator = null, $value = null) {
    $path = EloquentJsonMacros::prepareJsonPath($path);

    list($value, $operator) = $this->getQuery()->prepareValueAndOperator(
        $value, $operator, func_num_args() === 2
    );

    return $this->orWhereRaw("JSON_LENGTH($path) $operator :value", [
        'value' => $value
    ]);
});
