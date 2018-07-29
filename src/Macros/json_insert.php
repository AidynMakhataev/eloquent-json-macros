<?php

use Illuminate\Support\Facades\DB;
use AidynMakhataev\EloquentJsonMacros\EloquentJsonMacros;

if (! function_exists('json_insert')) {

    /**
     * Inserts data into a JSON document.
     *
     * @param string $column
     * @param array $pathValue
     *
     * @return \Illuminate\Database\Query\Expression
     */
    function json_insert(string $column, array $pathValue): \Illuminate\Database\Query\Expression
    {
        array_walk($pathValue, function (&$value, $path) {
            $value = "'".EloquentJsonMacros::formatJsonPath($path)."',".EloquentJsonMacros::formatValue($value);
        });

        $pathValue = implode(',', $pathValue);

        $raw = DB::raw("JSON_INSERT($column, $pathValue)");

        return $raw;
    }
}
