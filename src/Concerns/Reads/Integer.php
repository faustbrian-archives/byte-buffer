<?php

namespace BrianFaust\ByteBuffer\Concerns\Reads;

trait Integer
{
    public function readInt8(int $offset = 0): self
    {
        return $this->unpack('c', $offset);
    }

    public function readInt16(int $offset = 0): self
    {
        return $this->unpack('s', $offset);
    }

    public function readInt32(int $offset = 0): self
    {
        return $this->unpack('l', $offset);
    }

    public function readInt64(int $offset = 0): self
    {
        return $this->unpack('q', $offset);
    }

    public function readByte(int $offset = 0): self
    {
        return $this->readInt8($offset);
    }

    public function readShort(int $offset = 0): self
    {
        return $this->readInt16($offset);
    }

    public function readInt(int $offset = 0): self
    {
        return $this->readInt32($offset);
    }

    public function readLong(int $offset = 0): self
    {
        return $this->readInt64($offset);
    }
}
