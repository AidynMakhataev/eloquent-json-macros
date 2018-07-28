<?php

use Illuminate\Database\Eloquent\Builder;
use AidynMakhataev\EloquentJsonMacros\EloquentJsonMacros;



/**
 * Add a orWhere "json_extract" clause to the query.
 * 
 * @param string $path
 * @param mixed  $operator
 * @param mixed  $value
 *    
 * @return Builder
 */
Builder::macro('orWhereJsonExtract', function ($path, $operator = null, $value = null) {
    
    list($column, $path) = EloquentJsonMacros::prepareJsonPath($path, 'json_extract');

    list($value, $operator) = $this->getQuery()->prepareValueAndOperator(
        $value, $operator, func_num_args() === 2 
    );

    return $this->whereRaw("JSON_UNQUOTE(JSON_EXTRACT($column, '$path')) $operator '$value'");
});