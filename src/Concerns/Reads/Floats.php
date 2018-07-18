<?php

namespace BrianFaust\ByteBuffer\Concerns\Reads;

trait Floats
{
    public function readFloat(int $offset = 0): float
    {
        return $this->unpack(['G', 'g', 'f'][$this->endianness], $offset);
    }

    public function readDouble(int $offset = 0): float
    {
        return $this->unpack(['E', 'e', 'd'][$this->endianness], $offset);
    }
}
