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
 * This is the sizeable trait.
 *
 * @author Brian Faust <envoyer@pm.me>
 */
trait Sizeable
{
    /**
     * Gets the capacity of this ByteBuffers backing buffer.
     *
     * @return int
     */
    public function capacity(): int
    {
        return count($this->buffer);
    }

    /**
     * Makes sure that this ByteBuffer is backed by a buffer of at least the specified capacity.
     *
     * @param int $capacity
     *
     * @return \BrianFaust\ByteBuffer\ByteBuffer
     */
    public function ensureCapacity(int $capacity): self
    {
        $current = $this->capacity();

        if ($current < $capacity) {
            return $this->resize($capacity);
        }

        return $this;
    }

    /**
     * Resizes this ByteBuffer to be backed by a buffer of at least the given capacity.
     *
     * @param int $capacity
     *
     * @return \BrianFaust\ByteBuffer\ByteBuffer
     */
    public function resize(int $capacity): self
    {
        $current = $this->buffer;

        $this->initializeBuffer($capacity, pack("x{$capacity}"));

        $this->buffer = array_replace($this->buffer, $current);

        return $this;
    }

    /**
     * Gets the number of remaining readable bytes.
     *
     * @return int
     */
    public function remaining(): int
    {
        return $this->length - $this->offset;
    }
}
