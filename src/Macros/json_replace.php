<?php

use AidynMakhataev\EloquentJsonMacros\EloquentJsonMacros;
use Illuminate\Support\Facades\DB;

if(!function_exists('json_replace')) {
    
    /**
     * Replaces existing values in a JSON document
     *
     * @param string $column
     * @param array  $pathValue
     * 
     * @return \Illuminate\Database\Query\Expression
     */
    function json_replace(string $column, array $pathValue): \Illuminate\Database\Query\Expression
    {
        array_walk($pathValue, function (&$value, $path) {
            $value = "'" . EloquentJsonMacros::formatJsonPath($path) . "'," . EloquentJsonMacros::formatValue($value);
        });

        $pathValue = implode(',' , $pathValue);

        $raw = DB::raw("JSON_REPLACE($column, $pathValue)");
            
        return $raw;
    }
}