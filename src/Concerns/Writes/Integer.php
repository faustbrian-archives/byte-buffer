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
 * This is the integer writer trait.
 *
 * @author Brian Faust <envoyer@pm.me>
 */
trait Integer
{
    /**
     * Writes a 8bit signed integer.
     *
     * @param int $value
     * @param int $offset
     *
     * @return \BrianFaust\ByteBuffer\Contracts\Buffable
     */
    public function writeInt8(int $value, int $offset = 0): Buffable
    {
        return $this->pack('c', $value, $offset);
    }

    /**
     * Writes a 16bit signed integer.
     *
     * @param int $value
     * @param int $offset
     *
     * @return \BrianFaust\ByteBuffer\Contracts\Buffable
     */
    public function writeInt16(int $value, int $offset = 0): Buffable
    {
        return $this->pack('s', $value, $offset);
    }

    /**
     * Writes a 32bit signed integer.
     *
     * @param int $value
     * @param int $offset
     *
     * @return \BrianFaust\ByteBuffer\Contracts\Buffable
     */
    public function writeInt32(int $value, int $offset = 0): Buffable
    {
        return $this->pack('l', $value, $offset);
    }

    /**
     * Writes a 64bit signed integer.
     *
     * @param int $value
     * @param int $offset
     *
     * @return \BrianFaust\ByteBuffer\Contracts\Buffable
     */
    public function writeInt64(int $value, int $offset = 0): Buffable
    {
        return $this->pack('q', $value, $offset);
    }

    /**
     * Writes an 8bit signed integer. This is an alias of writeInt8.
     *
     * @param int $value
     * @param int $offset
     *
     * @return \BrianFaust\ByteBuffer\Contracts\Buffable
     */
    public function writeByte(int $value, int $offset = 0): Buffable
    {
        return $this->writeInt8($value, $offset);
    }

    /**
     * Writes a 16bit signed integer. This is an alias of writeInt16.
     *
     * @param int $value
     * @param int $offset
     *
     * @return \BrianFaust\ByteBuffer\Contracts\Buffable
     */
    public function writeShort(int $value, int $offset = 0): Buffable
    {
        return $this->writeInt16($value, $offset);
    }

    /**
     * Writes a 32bit signed integer. This is an alias of writeInt32.
     *
     * @param int $value
     * @param int $offset
     *
     * @return \BrianFaust\ByteBuffer\Contracts\Buffable
     */
    public function writeInt(int $value, int $offset = 0): Buffable
    {
        return $this->writeInt32($value, $offset);
    }

    /**
     * Writes a 64bit signed integer. This is an alias of writeInt64.
     *
     * @param int $value
     * @param int $offset
     *
     * @return \BrianFaust\ByteBuffer\Contracts\Buffable
     */
    public function writeLong(int $value, int $offset = 0): Buffable
    {
        return $this->writeInt64($value, $offset);
    }
}
