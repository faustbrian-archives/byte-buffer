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

class ByteOrder
{
    /**
     * Big endian constant that can be used instead of its numerical value.
     */
    const BE = 0;

    /**
     * Little endian constant that can be used instead of its numerical value.
     */
    const LE = 1;

    /**
     * Machine byte constant that can be used instead of its numerical value.
     */
    const MB = 2;
}
