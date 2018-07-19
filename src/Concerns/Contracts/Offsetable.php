<?php

namespace BrianFaust\ByteBuffer\Contracts;

interface Offsetable
{
    /**
     * Determine if the given offset exists.
     *
     * @param int $offset
     *
     * @return bool
     */
    public function offsetExists(int $offset): bool;

    /**
     * Get the value for a given offset.
     *
     * @param int $offset
     *
     * @return mixed
     */
    public function offsetGet(int $offset);

    /**
     * Set the value at the given offset.
     *
     * @param int   $offset
     * @param mixed $value
     */
    public function offsetSet(int $offset, $value): void;

    /**
     * Unset the value at the given offset.
     *
     * @param int $offset
     */
    public function offsetUnset(int $offset): void;
}
