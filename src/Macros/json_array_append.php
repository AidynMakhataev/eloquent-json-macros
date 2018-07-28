<?php

use AidynMakhataev\EloquentJsonMacros\EloquentJsonMacros;
use Illuminate\Support\Facades\DB;

if(!function_exists('json_array_append')) {
    
    /**
     * Appends values to the end of the indicated arrays within a JSON document
     *
     * @param string $column
     * @param string $path
     * @param mixed  $value
     * @return \Illuminate\Database\Query\Expression
     */
    function json_array_append($column, $path, $value)
    {
        $path = EloquentJsonMacros::formatJsonPath($path);
        $raw = DB::raw("JSON_ARRAY_APPEND($column, '$path', $value)");
        
        return $raw;
    }
}