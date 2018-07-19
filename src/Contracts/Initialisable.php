<?php

namespace BrianFaust\ByteBuffer\Contracts;

use BrianFaust\ByteBuffer\ByteBuffer;

/**
 * This is the initialisable interface.
 *
 * @author Brian Faust <envoyer@pm.me>
 */
interface Initialisable
{
    /**
     * Creates a ByteBuffer from a binary string.
     *
     * @param string $value
     *
     * @return \BrianFaust\ByteBuffer\ByteBuffer
     */
    public static function fromBinary(string $value): ByteBuffer;

    /**
     * Creates a ByteBuffer from a hex string.
     *
     * @param string $value
     *
     * @return \BrianFaust\ByteBuffer\ByteBuffer
     */
    public static function fromHex(string $value): ByteBuffer;

    /**
     * Creates a ByteBuffer from a UTF-8 string.
     *
     * @param string $value
     *
     * @return \BrianFaust\ByteBuffer\ByteBuffer
     */
    public static function fromUTF8(string $value): ByteBuffer;

    /**
     * Creates a ByteBuffer from a base64 string.
     *
     * @param string $value
     *
     * @return \BrianFaust\ByteBuffer\ByteBuffer
     */
    public static function fromBase64(string $value): ByteBuffer;

    /**
     * Creates a ByteBuffer from an array.
     *
     * @param array $value
     *
     * @return \BrianFaust\ByteBuffer\ByteBuffer
     */
    public static function fromArray(array $value): ByteBuffer;

    /**
     * Get the buffer as a plain string.
     *
     * @param string $value
     * @param string $encoding
     *
     * @return \BrianFaust\ByteBuffer\ByteBuffer
     */
    public function fromString(string $value, string $encoding): ByteBuffer;
}
