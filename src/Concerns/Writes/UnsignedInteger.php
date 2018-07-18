<?php

namespace BrianFaust\ByteBuffer\Concerns\Writes;

trait UnsignedInteger
{
    public function writeUInt8(int $value, int $offset = 0): self
    {
        $format = 'C';

        $this->checkForExcess(0xff, $value);

        return $this->pack($format, $value, $offset);
    }

    public function writeUInt16(int $value, int $offset = 0): self
    {
        $format = ['n', 'v', 'S'][$this->endianness];

        $this->checkForExcess(0xffff, $value);

        return $this->pack($format, $value, $offset);
    }

    public function writeUInt32(int $value, int $offset = 0): self
    {
        $format = ['N', 'V', 'L'][$this->endianness];

        $this->checkForExcess(0xffffffff, $value);

        return $this->pack($format, $value, $offset);
    }

    public function writeUInt64(int $value, int $offset = 0): self
    {
        $format = ['J', 'P', 'Q'][$this->endianness];

        $this->checkForExcess(0xffffffffffffffff, $value);

        return $this->pack($format, $value, $offset);
    }

    public function writeUByte(int $value, int $offset = 0): self
    {
        return $this->writeUInt8($value, $offset);
    }

    public function writeUShort(int $value, int $offset = 0): self
    {
        return $this->writeUInt16($value, $offset);
    }

    public function writeUInt(int $value, int $offset = 0): self
    {
        return $this->writeUInt32($value, $offset);
    }

    public function writeULong(int $value, int $offset = 0): self
    {
        return $this->writeUInt64($value, $offset);
    }
}
