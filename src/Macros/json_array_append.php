<?php

use AidynMakhataev\EloquentJsonMacros\EloquentJsonMacros;
use Illuminate\Support\Facades\DB;

if(!function_exists('json_array_append')) {
    
    /**
     * Appends values to the end of the indicated arrays within a JSON document
     *
     * @param string $column
     * @param array  $pathValue
     * 
     * @return \Illuminate\Database\Query\Expression
     */
    function json_array_append(string $column, array $pathValue): \Illuminate\Database\Query\Expression 
    {
        array_walk($pathValue, function (&$value, $path) {
            $value = "'" . EloquentJsonMacros::formatJsonPath($path) . "'," . EloquentJsonMacros::formatValue($value);
        });

        $pathValue = implode(',' , $pathValue);
        
        $raw = DB::raw("JSON_ARRAY_APPEND($column, $pathValue)");
        
        return $raw;
    }
}