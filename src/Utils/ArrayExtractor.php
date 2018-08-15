<?php

namespace CustomerIo\Utils;

final class ArrayExtractor
{
    public static function get(array $array, string $key)
    {
        return $array[$key] ?? null;
    }

    public static function getAsString(array $array, string $key): ?string
    {
        return isset($array[$key]) && !\is_array($array[$key]) ? (string)$array[$key] : null;
    }

    public static function getAsInt(array $array, $key): ?int
    {
        return isset($array[$key]) && !\is_array($array[$key]) ? (int)$array[$key] : null;
    }

    public static function getAsNumeric(array $array, $key): ?string
    {
        return isset($array[$key]) && is_numeric($array[$key]) ? (string)$array[$key] : null;
    }

    public static function getAsFloat(array $array, $key): ?float
    {
        return isset($array[$key]) && !\is_array($array[$key]) ? (float)$array[$key] : null;
    }

    public static function getAsBool(array $array, $key): ?bool
    {
        return isset($array[$key]) && !\is_array($array[$key]) ? (bool)json_decode($array[$key]) : null;
    }

    public static function getAsArray(array $array, $key): ?array
    {
        return isset($array[$key]) && \is_array($array[$key]) ? $array[$key] : null;
    }

    public static function getAsDateTime(array $array, $key, $format = DATE_W3C): ?\DateTime
    {
        $dateAsString = self::getAsString($array, $key);
        if ($dateAsString === null) {
            return null;
        }

        return \DateTime::createFromFormat($format, $dateAsString) ?: null;
    }
}
