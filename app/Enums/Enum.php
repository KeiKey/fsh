<?php

namespace App\Enums;

use Exception;
use ReflectionClass;

abstract class Enum
{
    /**
     * @param string $glue
     * @return string
     */
    public static function toString(string $glue = ','): string
    {
        return implode($glue, self::toArray());
    }

    /**
     * @param bool $associative
     * @return array
     */
    public static function toArray(bool $associative = false): array
    {
        try {
            $constants = (new ReflectionClass(static::class))->getConstants();

            if ($associative) {
                $associativeConstants = array_combine($constants, $constants);

                if ($associativeConstants) {
                    return $associativeConstants;
                }
            }

            return array_values($constants);
        } catch (Exception $e) {
            return [];
        }
    }
}
