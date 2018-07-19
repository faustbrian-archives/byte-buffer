<?php

declare(strict_types=1);

/*
 * This file is part of ByteBuffer.
 *
 * (c) Brian Faust <envoyer@pm.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BrianFaust\ByteBuffer;

use InvalidArgumentException;

/**
 * This is the length map class.
 *
 * @author Brian Faust <envoyer@pm.me>
 */
class LengthMap
{
    /**
     * [$lengths description].
     *
     * @var array
     */
    private static $lengths = [
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

        // Float (32 bit)
        'G' => 4,
        'g' => 4,
        'f' => 4,

        // Float (64 bit)
        'E' => 8,
        'e' => 8,
        'd' => 8,
    ];

    /**
     * Get a value from the list of lengths.
     *
     * @param string $format
     *
     * @return int
     */
    public static function get(string $format): int
    {
        if (!array_key_exists($format, static::$lengths)) {
            throw new InvalidArgumentException("The given format [{$format}] is not supported.");
        }

        return static::$lengths[$format];
    }
}
