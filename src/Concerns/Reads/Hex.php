<?php

namespace BrianFaust\ByteBuffer\Concerns\Reads;

trait Hex
{
    /**
     * Reads a base16 encoded string.
     *
     * @param int $length
     *
     * @return string
     */
    public function readHex(int $length): string
    {
        $length *= 2;

        return $this->unpack("H{$length}", $length / 2);
    }

    public function readHexBytes(int $length): string
    {
        return hex2bin($this->readHexRaw($length));
    }

    public function readHexRaw(int $length): string
    {
        return substr($this->hex, $this->offset, $length);
    }
}
