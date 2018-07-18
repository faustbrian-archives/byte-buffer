<?php

namespace BrianFaust\ByteBuffer\Concerns\Writes;

trait Hex
{
    public function writeHex(string $value, int $offset = 0): self
    {
        $length = strlen($value);

        return $this->pack("H{$length}", $value, $offset, $length);
    }
}
