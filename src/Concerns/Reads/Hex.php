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

namespace BrianFaust\ByteBuffer\Concerns\Reads;

/**
 * This is the hex reader trait.
 *
 * @author Brian Faust <envoyer@pm.me>
 */
trait Hex
{
    /**
     * Reads a base16 encoded string.
     *
     * @param int $length
     *
     * @return string
     */
    public function readHex(int $length): string
    {
        $length *= 2;

        return $this->unpack("H{$length}", $length / 2);
    }

    public function readHexBytes(int $length): string
    {
        return hex2bin($this->readHexRaw($length));
    }

    public function readHexRaw(int $length): string
    {
        return substr($this->hex, $this->offset, $length);
    }
}
