<?php

namespace BrianFaust\ByteBuffer\Contracts;

/**
 * This is the sizeable interface.
 *
 * @author Brian Faust <envoyer@pm.me>
 */
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
     * @return \BrianFaust\ByteBuffer\Contracts\Buffable
     */
    public function ensureCapacity(int $capacity): Buffable;

    /**
     * Resizes this ByteBuffer to be backed by a buffer of at least the given capacity.
     *
     * @param int $capacity
     *
     * @return \BrianFaust\ByteBuffer\Contracts\Buffable
     */
    public function resize(int $capacity): Buffable;

    /**
     * Gets the number of remaining readable bytes.
     *
     * @return int
     */
    public function remaining(): int;
}
