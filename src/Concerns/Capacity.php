<?php

namespace BrianFaust\ByteBuffer\Concerns;

trait Capacity
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
        $this->buffer = $this->slice(0, $capacity);
        $this->length = $capacity;

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
