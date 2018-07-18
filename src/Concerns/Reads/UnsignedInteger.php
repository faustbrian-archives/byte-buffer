<?php

namespace BrianFaust\ByteBuffer\Concerns\Reads;

trait UnsignedInteger
{
    public function readUInt8(int $offset = 0): int
    {
        return $this->unpack('C', $offset);
    }

    public function readUInt16(int $offset = 0): int
    {
        return $this->unpack(['n', 'v', 'S'][$this->endianness], $offset);
    }

    public function readUInt32(int $offset = 0): int
    {
        return $this->unpack(['N', 'V', 'L'][$this->endianness], $offset);
    }

    public function readUInt64(int $offset = 0): int
    {
        return $this->unpack(['J', 'P', 'Q'][$this->endianness], $offset);
    }

    public function readUByte(int $offset = 0): self
    {
        return $this->readUInt8($offset);
    }

    public function readUShort(int $offset = 0): self
    {
        return $this->readUInt16($offset);
    }

    public function readUInt(int $offset = 0): self
    {
        return $this->readUInt32($offset);
    }

    public function readULong(int $offset = 0): self
    {
        return $this->readUInt64($offset);
    }
}
