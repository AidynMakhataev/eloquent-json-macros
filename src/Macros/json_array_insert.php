<?php

use Illuminate\Support\Facades\DB;
use AidynMakhataev\EloquentJsonMacros\EloquentJsonMacros;

if (! function_exists('json_array_insert')) {

    /**
     * Updates a JSON document, inserting into an array within the document.
     *
     * @param string $column
     * @param array  $pathValue
     *
     * @return \Illuminate\Database\Query\Expression
     */
    function json_array_insert(string $column, array $pathValue): \Illuminate\Database\Query\Expression
    {
        array_walk($pathValue, function (&$value, $path) {
            $value = "'".EloquentJsonMacros::formatJsonPath($path)."',".EloquentJsonMacros::formatValue($value);
        });

        $pathValue = implode(',', $pathValue);

        $raw = DB::raw("JSON_ARRAY_INSERT($column, $pathValue)");

        return $raw;
    }
}
