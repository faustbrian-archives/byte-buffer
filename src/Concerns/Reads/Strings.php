<?php

namespace BrianFaust\ByteBuffer\Concerns\Reads;

trait Strings
{
    public function readCString(int $offset = 0): self
    {
        return $this;
    }

    public function readIString(int $offset = 0): self
    {
        return $this;
    }

    public function readString(int $length, int $offset = 0): self
    {
        return $this;
    }

    public function readUTF8String(int $length, int $offset = 0): self
    {
        return $this;
    }

    public function readVString(int $offset = 0): self
    {
        return $this;
    }
}
