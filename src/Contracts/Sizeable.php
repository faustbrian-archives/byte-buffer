<?php

namespace BrianFaust\ByteBuffer\Contracts;

use BrianFaust\ByteBuffer\ByteBuffer;

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
     * @return \BrianFaust\ByteBuffer\ByteBuffer
     */
    public function ensureCapacity(int $capacity): ByteBuffer;

    /**
     * Resizes this ByteBuffer to be backed by a buffer of at least the given capacity.
     *
     * @param int $capacity
     *
     * @return \BrianFaust\ByteBuffer\ByteBuffer
     */
    public function resize(int $capacity): ByteBuffer;

    /**
     * Gets the number of remaining readable bytes.
     *
     * @return int
     */
    public function remaining(): int;
}
