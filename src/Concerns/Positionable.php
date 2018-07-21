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

use BrianFaust\ByteBuffer\Contracts\Buffable;

/**
 * This is the positionable trait.
 *
 * @author Brian Faust <envoyer@pm.me>
 */
trait Positionable
{
    /**
     * {@inheritdoc}
     */
    public function current(): int
    {
        return $this->offset;
    }

    /**
     * {@inheritdoc}
     */
    public function position(int $offset): Buffable
    {
        $this->offset = $offset;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function skip(int $length): Buffable
    {
        $this->offset += $length;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function rewind(int $length): Buffable
    {
        $this->offset -= $length;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function reset(): Buffable
    {
        $this->offset = 0;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function clear(): Buffable
    {
        $this->offset = 0;
        $this->length = count($this->buffer);

        return $this;
    }
}
