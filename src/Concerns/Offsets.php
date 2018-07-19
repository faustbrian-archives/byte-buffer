<?php

namespace BrianFaust\ByteBuffer\Concerns;

trait Offsets
{
    /**
     * Determine if the given offset exists.
     *
     * @param int $offset
     *
     * @return bool
     */
    public function offsetExists(int $offset): bool
    {
        return isset($this->buffer[$offset]);
    }

    /**
     * Get the value for a given offset.
     *
     * @param int $offset
     *
     * @return mixed
     */
    public function offsetGet(int $offset)
    {
        return $this->get($offset);
    }

    /**
     * Set the value at the given offset.
     *
     * @param int   $offset
     * @param mixed $value
     */
    public function offsetSet(int $offset, $value): void
    {
        $this->buffer[$offset] = $value;
    }

    /**
     * Unset the value at the given offset.
     *
     * @param int $offset
     */
    public function offsetUnset(int $offset): void
    {
        unset($this->buffer[$offset]);
    }
}
