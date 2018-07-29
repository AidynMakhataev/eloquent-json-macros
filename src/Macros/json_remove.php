<?php

use Illuminate\Support\Facades\DB;
use AidynMakhataev\EloquentJsonMacros\EloquentJsonMacros;

if (! function_exists('json_remove')) {

    /**
     * Removes data from a JSON document.
     *
     * @param string $column
     * @param mixed  $path
     *
     * @return \Illuminate\Database\Query\Expression
     */
    function json_remove(string $column, $path): \Illuminate\Database\Query\Expression
    {
        if (is_array($path)) {
            foreach ($path as $key => $item) {
                $path[$key] = "'".EloquentJsonMacros::formatJsonPath($item)."'";
            }
            $path = implode(',', $path);
        } else {
            $path = "'".EloquentJsonMacros::formatJsonPath($path)."'";
        }

        $raw = DB::raw("JSON_REMOVE($column, $path)");

        return $raw;
    }
}
