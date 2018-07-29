<?php

namespace AidynMakhataev\EloquentJsonMacros;

class EloquentJsonMacros
{
    /**
     * Formatting json path.
     *
     * @param string $path
     * @return string
     */
    public static function formatJsonPath($path): string
    {
        if (starts_with($path, '[')) {
            return "$$path";
        }

        return "$.$path";
    }

    /**
     * Format value.
     *
     * @param mixed $value
     * @return mixed
     */
    public static function formatValue($value)
    {
        if (is_string($value)) {
            return "'".$value."'";
        }

        return $value;
    }

    /**
     * Formatting needle.
     *
     * @param string $needle
     * @return string
     */
    public static function formatNeedle($needle): string
    {
        if (is_numeric($needle) && ! is_string($needle)) {
            return "'".$needle."'";
        }

        return  "'".'"'.$needle.'"'."'";
    }

    /**
     * Prepare json path for query.
     *
     * @param string $path
     * @param null|string $type
     * @return mixed
     */
    public static function prepareJsonPath($path, $type = null)
    {
        if (str_contains($path, '->')) {
            list($column, $jsonPath) = explode('->', $path);
        } else {
            list($column, $jsonPath) = ['', $path];
        }
        switch ($type) {
            case 'json_extract':
                return [$column, self::formatJsonPath($jsonPath)];
                break;
            default:
                if (strlen($column) > 0) {
                    return "$column->'".self::formatJsonPath($jsonPath)."'";
                }

                return $path;

                break;
        }
    }
}
