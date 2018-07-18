<?php

namespace BrianFaust\ByteBuffer\Concerns\Writes;

trait Integer
{
    public function writeInt8(int $value, int $offset = 0): self
    {
        return $this->pack('c', $value, $offset);
    }

    public function writeInt16(int $value, int $offset = 0): self
    {
        return $this->pack('s', $value, $offset);
    }

    public function writeInt32(int $value, int $offset = 0): self
    {
        return $this->pack('l', $value, $offset);
    }

    public function writeInt64(int $value, int $offset = 0): self
    {
        return $this->pack('q', $value, $offset);
    }

    public function writeByte(int $value, int $offset = 0): self
    {
        return $this->writeInt8($value, $offset);
    }

    public function writeShort(int $value, int $offset = 0): self
    {
        return $this->writeInt16($value, $offset);
    }

    public function writeInt(int $value, int $offset = 0): self
    {
        return $this->writeInt32($value, $offset);
    }

    public function writeLong(int $value, int $offset = 0): self
    {
        return $this->writeInt64($value, $offset);
    }
}
