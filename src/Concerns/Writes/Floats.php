<?php

namespace BrianFaust\ByteBuffer\Concerns\Writes;

trait Floats
{
    public function writeFloat(float $value, int $offset = 0): self
    {
        return $this->pack(['G', 'g', 'f'][$this->endianness], $value, $offset);
    }

    public function writeDouble(float $value, int $offset = 0): self
    {
        return $this->pack(['E', 'e', 'd'][$this->endianness], $value, $offset);
    }
}
