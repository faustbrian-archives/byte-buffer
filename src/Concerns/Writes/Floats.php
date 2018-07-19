<?php

namespace BrianFaust\ByteBuffer\Concerns\Writes;

trait Floats
{
    /**
     * Writes a 32bit float.
     *
     * @param float $value
     * @param int   $offset
     *
     * @return \BrianFaust\ByteBuffer\ByteBuffer
     */
    public function writeFloat32(float $value, int $offset = 0): self
    {
        $this->checkForExcess(0xffffffff, $value);

        return $this->pack(['G', 'g', 'f'][$this->endianness], $value, $offset);
    }

    /**
     * Writes a 64bit float.
     *
     * @param float $value
     * @param int   $offset
     *
     * @return \BrianFaust\ByteBuffer\ByteBuffer
     */
    public function writeFloat64(float $value, int $offset = 0): self
    {
        $this->checkForExcess(0xffffffffffffffff, $value);

        return $this->pack(['E', 'e', 'd'][$this->endianness], $value, $offset);
    }

    /**
     * Writes a 64bit float. This is an alias of writeFloat64.
     *
     * @param float $value
     * @param int   $offset
     *
     * @return \BrianFaust\ByteBuffer\ByteBuffer
     */
    public function writeDouble(float $value, int $offset = 0): self
    {
        return $this->writeFloat64($value, $offset);
    }
}
