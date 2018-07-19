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
 * This is the unsigned integer writer trait.
 *
 * @author Brian Faust <envoyer@pm.me>
 */
trait UnsignedInteger
{
    /**
     * Writes an 8bit unsigned integer.
     *
     * @param int $value
     * @param int $offset
     *
     * @return \BrianFaust\ByteBuffer\Contracts\Buffable
     */
    public function writeUInt8(int $value, int $offset = 0): Buffable
    {
        $format = 'C';

        $this->checkForExcess(0xff, $value);

        return $this->pack($format, $value, $offset);
    }

    /**
     * Writes an icbit unsigned integer.
     *
     * @param int $value
     * @param int $offset
     *
     * @return \BrianFaust\ByteBuffer\Contracts\Buffable
     */
    public function writeUInt16(int $value, int $offset = 0): Buffable
    {
        $format = ['n', 'v', 'S'][$this->endianness];

        $this->checkForExcess(0xffff, $value);

        return $this->pack($format, $value, $offset);
    }

    /**
     * Writes an 32bit unsigned integer.
     *
     * @param int $value
     * @param int $offset
     *
     * @return \BrianFaust\ByteBuffer\Contracts\Buffable
     */
    public function writeUInt32(int $value, int $offset = 0): Buffable
    {
        $format = ['N', 'V', 'L'][$this->endianness];

        $this->checkForExcess(0xffffffff, $value);

        return $this->pack($format, $value, $offset);
    }

    /**
     * Writes an 64bit unsigned integer.
     *
     * @param int $value
     * @param int $offset
     *
     * @return \BrianFaust\ByteBuffer\Contracts\Buffable
     */
    public function writeUInt64(int $value, int $offset = 0): Buffable
    {
        $format = ['J', 'P', 'Q'][$this->endianness];

        $this->checkForExcess(0xffffffffffffffff, $value);

        return $this->pack($format, $value, $offset);
    }

    /**
     * Writes an 8bit unsigned integer. This is an alias of writeUInt8.
     *
     * @param int $value
     * @param int $offset
     *
     * @return \BrianFaust\ByteBuffer\Contracts\Buffable
     */
    public function writeUByte(int $value, int $offset = 0): Buffable
    {
        return $this->writeUInt8($value, $offset);
    }

    /**
     * Writes an 16bit unsigned integer. This is an alias of writeUInt16.
     *
     * @param int $value
     * @param int $offset
     *
     * @return \BrianFaust\ByteBuffer\Contracts\Buffable
     */
    public function writeUShort(int $value, int $offset = 0): Buffable
    {
        return $this->writeUInt16($value, $offset);
    }

    /**
     * Writes an 32bit unsigned integer. This is an alias of writeUInt32.
     *
     * @param int $value
     * @param int $offset
     *
     * @return \BrianFaust\ByteBuffer\Contracts\Buffable
     */
    public function writeUInt(int $value, int $offset = 0): Buffable
    {
        return $this->writeUInt32($value, $offset);
    }

    /**
     * Writes an 64bit unsigned integer. This is an alias of writeUInt64.
     *
     * @param int $value
     * @param int $offset
     *
     * @return \BrianFaust\ByteBuffer\Contracts\Buffable
     */
    public function writeULong(int $value, int $offset = 0): Buffable
    {
        return $this->writeUInt64($value, $offset);
    }
}
