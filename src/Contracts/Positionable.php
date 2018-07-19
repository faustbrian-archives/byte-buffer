<?php

namespace BrianFaust\ByteBuffer\Contracts;

use BrianFaust\ByteBuffer\ByteBuffer;

/**
 * This is the positionable interface.
 *
 * @author Brian Faust <envoyer@pm.me>
 */
interface Positionable
{
    /**
     * Gets the absolute read/write offset.
     *
     * @return int
     */
    public function current(): int;

    /**
     * Sets this ByteBuffers absolute read/write offset.
     *
     * @param int $offset
     *
     * @return \BrianFaust\ByteBuffer\ByteBuffer
     */
    public function position(int $offset): ByteBuffer;

    /**
     * Skips the next `length` bytes. May also be negative to move the offset back.
     *
     * @param int $length
     *
     * @return \BrianFaust\ByteBuffer\ByteBuffer
     */
    public function skip(int $length): ByteBuffer;

    /**
     * Resets this ByteBuffers offset.
     *
     * @return \BrianFaust\ByteBuffer\ByteBuffer
     */
    public function reset(): ByteBuffer;

    /**
     * Clears this ByteBuffers offsets.
     *
     * @return \BrianFaust\ByteBuffer\ByteBuffer
     */
    public function clear(): ByteBuffer;
}
