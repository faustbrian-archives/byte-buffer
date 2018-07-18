<?php

namespace BrianFaust\ByteBuffer;

class LengthMap
{
    private static $map = [
        // Chars (8 bit)
        'c' => 1,
        'C' => 1,

        // Signed Short (16 bit)
        's' => 2,

        // Unsigned Short (16 bit)
        'n' => 2,
        'S' => 2,
        'v' => 2,

        // Signed Long  (32 bit)
        'l' => 4,

        // Unsigned Long  (32 bit)
        'L' => 4,
        'N' => 4,
        'V' => 4,

        // Signed Long Long (64 bit)
        'q' => 8,

        // Unsigned Long Long (64 bit)
        'J' => 8,
        'P' => 8,
        'Q' => 8,

        // Float
        'G' => 4,
        'g' => 4,
        'f' => 4,

        // Double
        'E' => 8,
        'e' => 8,
        'd' => 8,
    ];

    public static function get(string $format, int $default = 0): int
    {
        if (!array_key_exists($format, static::$map)) {
            return $default;
        }

        return static::$map[$format];
    }
}
