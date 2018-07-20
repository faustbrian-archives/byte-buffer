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
 * This is the offsetable trait.
 *
 * @author Brian Faust <envoyer@pm.me>
 */
trait Offsetable
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
        return $this->buffer[$offset];
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
