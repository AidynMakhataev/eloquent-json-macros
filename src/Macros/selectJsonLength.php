<?php

use Illuminate\Database\Eloquent\Builder;
use AidynMakhataev\EloquentJsonMacros\EloquentJsonMacros;



/**
 * Add a "json_length" select expression to the query.
 * 
 * @param string $path
 * @param string $resultName
 *  
 * @return Builder
 */
Builder::macro('selectJsonLength', function ($path, $resultName = 'jsonResult') {
    
    $path = EloquentJsonMacros::prepareJsonPath($path);

    return $this->selectRaw("JSON_LENGTH($path) AS $resultName");
});