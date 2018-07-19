<?php

namespace BrianFaust\ByteBuffer\Concerns\Writes;

trait UnsignedInteger
{
    /**
     * Writes an 8bit unsigned integer.
     *
     * @param int $value
     * @param int $offset
     *
     * @return \BrianFaust\ByteBuffer\ByteBuffer
     */
    public function writeUInt8(int $value, int $offset = 0): self
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
     * @return \BrianFaust\ByteBuffer\ByteBuffer
     */
    public function writeUInt16(int $value, int $offset = 0): self
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
     * @return \BrianFaust\ByteBuffer\ByteBuffer
     */
    public function writeUInt32(int $value, int $offset = 0): self
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
     * @return \BrianFaust\ByteBuffer\ByteBuffer
     */
    public function writeUInt64(int $value, int $offset = 0): self
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
     * @return \BrianFaust\ByteBuffer\ByteBuffer
     */
    public function writeUByte(int $value, int $offset = 0): self
    {
        return $this->writeUInt8($value, $offset);
    }

    /**
     * Writes an 16bit unsigned integer. This is an alias of writeUInt16.
     *
     * @param int $value
     * @param int $offset
     *
     * @return \BrianFaust\ByteBuffer\ByteBuffer
     */
    public function writeUShort(int $value, int $offset = 0): self
    {
        return $this->writeUInt16($value, $offset);
    }

    /**
     * Writes an 32bit unsigned integer. This is an alias of writeUInt32.
     *
     * @param int $value
     * @param int $offset
     *
     * @return \BrianFaust\ByteBuffer\ByteBuffer
     */
    public function writeUInt(int $value, int $offset = 0): self
    {
        return $this->writeUInt32($value, $offset);
    }

    /**
     * Writes an 64bit unsigned integer. This is an alias of writeUInt64.
     *
     * @param int $value
     * @param int $offset
     *
     * @return \BrianFaust\ByteBuffer\ByteBuffer
     */
    public function writeULong(int $value, int $offset = 0): self
    {
        return $this->writeUInt64($value, $offset);
    }
}
