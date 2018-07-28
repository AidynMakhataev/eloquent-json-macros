<?php

use AidynMakhataev\EloquentJsonMacros\EloquentJsonMacros;
use Illuminate\Support\Facades\DB;

if(!function_exists('json_array_insert')) {
    
    /**
     * Updates a JSON document, inserting into an array within the document
     *
     * @param string $column
     * @param string $path
     * @param mixed  $value
     * @return \Illuminate\Database\Query\Expression
     */
    function json_array_insert($column, $path, $value)
    {
        $path = EloquentJsonMacros::formatJsonPath($path);
        $value = EloquentJsonMacros::formatValue($value);
        $raw = DB::raw("JSON_ARRAY_INSERT($column, '$path', $value)");
        
        return $raw;
    }
}