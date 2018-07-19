<?php

declare(strict_types=1);

/*
 * This file is part of ByteBuffer.
 *
 * (c) Brian Faust <envoyer@pm.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BrianFaust\ByteBuffer\Concerns;

/**
 * This is the positionable trait.
 *
 * @author Brian Faust <envoyer@pm.me>
 */
trait Positionable
{
    /**
     * Gets the absolute read/write offset.
     *
     * @return int
     */
    public function current(): int
    {
        return $this->offset;
    }

    /**
     * Sets this ByteBuffers absolute read/write offset.
     *
     * @param int $offset
     *
     * @return \BrianFaust\ByteBuffer\ByteBuffer
     */
    public function position(int $offset): self
    {
        $this->offset = $offset;

        return $this;
    }

    /**
     * Skips the next `length` bytes. May also be negative to move the offset back.
     *
     * @param int $length
     *
     * @return \BrianFaust\ByteBuffer\ByteBuffer
     */
    public function skip(int $length): self
    {
        $this->offset += $length;

        return $this;
    }

    /**
     * Resets this ByteBuffers offset.
     *
     * @return \BrianFaust\ByteBuffer\ByteBuffer
     */
    public function reset(): self
    {
        $this->offset = 0;

        return $this;
    }

    /**
     * Clears this ByteBuffers offsets.
     *
     * @return \BrianFaust\ByteBuffer\ByteBuffer
     */
    public function clear(): self
    {
        $this->offset = 0;
        $this->length = count($this->buffer);

        return $this;
    }
}
