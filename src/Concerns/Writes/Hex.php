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

namespace BrianFaust\ByteBuffer\Concerns\Writes;

use BrianFaust\ByteBuffer\Contracts\Buffable;

/**
 * This is the hex writer trait.
 *
 * @author Brian Faust <envoyer@pm.me>
 */
trait Hex
{
    /**
     * Writes a base16 encoded string.
     *
     * @param string $value
     * @param int    $offset
     *
     * @return \BrianFaust\ByteBuffer\Contracts\Buffable
     */
    public function writeHex(string $value, int $offset = 0): Buffable
    {
        $length = strlen($value);

        return $this->pack("H{$length}", $value, $offset);
    }
}
