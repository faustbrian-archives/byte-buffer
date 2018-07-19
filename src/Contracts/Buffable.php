<?php

namespace BrianFaust\ByteBuffer\Contracts;

/**
 * This is the buffable interface.
 *
 * @author Brian Faust <envoyer@pm.me>
 */
interface Buffable
{
    /**
     * Initialise a new buffer from the given content.
     *
     * @param int              $length
     * @param string|int|array $content
     */
    public function initializeBuffer(int $length, $content): void;

    /**
     * Pack data into binary string.
     *
     * @param string     $format
     * @param string|int $value
     * @param int        $offset
     *
     * @return \BrianFaust\ByteBuffer\Contracts\Buffable
     */
    public function pack(string $format, $value, int $offset): Buffable;

    /**
     * Unpack data from binary string.
     *
     * @param string $format
     * @param int    $offset
     *
     * @return string|int
     */
    public function unpack(string $format, int $offset = 0);
}
