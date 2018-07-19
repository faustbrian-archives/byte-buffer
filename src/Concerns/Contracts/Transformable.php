<?php

namespace BrianFaust\ByteBuffer\Contracts;

interface Transformable
{
    /**
     * Get the buffer as a binary string.
     *
     * @param int $offset
     * @param int $length
     *
     * @return array
     */
    public function toBinary(int $offset = 0, int $length = 0): string;

    /**
     * Get the buffer as a hex string.
     *
     * @param int $offset
     * @param int $length
     *
     * @return array
     */
    public function toHex(int $offset = 0, int $length = 0): string;

    /**
     * Get the buffer as a UTF-8 string.
     *
     * @param int $offset
     * @param int $length
     *
     * @return array
     */
    public function toUTF8(int $offset = 0, int $length = 0): string;

    /**
     * Get the buffer as a base64 string.
     *
     * @param int $offset
     * @param int $length
     *
     * @return array
     */
    public function toBase64(int $offset = 0, int $length = 0): string;

    /**
     * Get the buffer as an array.
     *
     * @param int $offset
     * @param int $length
     *
     * @return array
     */
    public function toArray(int $offset = 0, int $length = 0): array;

    /**
     * Get the buffer as a string.
     *
     * @param string $encoding
     * @param int    $offset
     * @param int    $length
     *
     * @return string
     */
    public function toString(string $encoding, int $offset = 0, int $length = 0): string;
}
