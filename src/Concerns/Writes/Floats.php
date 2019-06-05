<?php

declare(strict_types=1);

/*
 * This file is part of ByteBuffer.
 *
 * (c) Brian Faust <hello@basecode.sh>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BrianFaust\ByteBuffer\Concerns\Writes;

/**
 * This is the floats writer trait.
 *
 * @author Brian Faust <hello@basecode.sh>
 */
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
        return $this->pack(['G', 'g', 'f'][$this->order], $value, $offset);
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
        return $this->pack(['E', 'e', 'd'][$this->order], $value, $offset);
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
