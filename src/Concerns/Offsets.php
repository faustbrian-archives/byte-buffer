<?php

namespace BrianFaust\ByteBuffer\Concerns;

trait Offsets
{
    /**
     * Determine if the given offset exists.
     *
     * @param string $offset
     *
     * @return bool
     */
    public function offsetExists($offset): bool
    {
        return $this->buffer->offsetExists($offset);
    }

    /**
     * Get the value for a given offset.
     *
     * @param string $offset
     *
     * @return mixed
     */
    public function offsetGet($offset): string
    {
        return $this->buffer->offsetGet($offset);
    }

    /**
     * Set the value at the given offset.
     *
     * @param string $offset
     * @param mixed  $value
     */
    public function offsetSet($offset, $value): void
    {
        $this->buffer->offsetSet($offset, $value);
    }

    /**
     * Unset the value at the given offset.
     *
     * @param string $offset
     */
    public function offsetUnset($offset): void
    {
        $this->offsetUnset($offset);
    }
}
