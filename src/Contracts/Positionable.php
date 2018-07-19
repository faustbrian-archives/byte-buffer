<?php

namespace BrianFaust\ByteBuffer\Contracts;

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
     * @return \BrianFaust\ByteBuffer\Contracts\Buffable
     */
    public function position(int $offset): Buffable;

    /**
     * Skips the next `length` bytes. May also be negative to move the offset back.
     *
     * @param int $length
     *
     * @return \BrianFaust\ByteBuffer\Contracts\Buffable
     */
    public function skip(int $length): Buffable;

    /**
     * Resets this ByteBuffers offset.
     *
     * @return \BrianFaust\ByteBuffer\Contracts\Buffable
     */
    public function reset(): Buffable;

    /**
     * Clears this ByteBuffers offsets.
     *
     * @return \BrianFaust\ByteBuffer\Contracts\Buffable
     */
    public function clear(): Buffable;
}
