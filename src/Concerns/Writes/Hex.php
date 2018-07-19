<?php

namespace BrianFaust\ByteBuffer\Concerns\Writes;

trait Hex
{
    /**
     * Writes a base16 encoded string.
     *
     * @param string $value
     * @param int    $offset
     *
     * @return \BrianFaust\ByteBuffer\ByteBuffer
     */
    public function writeHex(string $value, int $offset = 0): self
    {
        $length = strlen($value);

        return $this->pack("H{$length}", $value, $offset, $length);
    }
}
