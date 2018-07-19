<?php

namespace BrianFaust\ByteBuffer\Contracts;

use BrianFaust\ByteBuffer\ByteBuffer;

interface Sizeable
{
    /**
     * Gets the capacity of this ByteBuffers backing buffer.
     *
     * @return int
     */
    public function capacity(): int;

    /**
     * Makes sure that this ByteBuffer is backed by a buffer of at least the specified capacity.
     *
     * @param int $capacity
     *
     * @return \BrianFaust\ByteBuffer\ByteBuffer
     */
    public function ensureCapacity(int $capacity): self;

    /**
     * Resizes this ByteBuffer to be backed by a buffer of at least the given capacity.
     *
     * @param int $capacity
     *
     * @return \BrianFaust\ByteBuffer\ByteBuffer
     */
    public function resize(int $capacity): self;

    /**
     * Gets the number of remaining readable bytes.
     *
     * @return int
     */
    public function remaining(): int;
}
