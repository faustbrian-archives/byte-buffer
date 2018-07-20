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
 * This is the initialisable trait.
 *
 * @author Brian Faust <envoyer@pm.me>
 */
trait Initialisable
{
    /**
     * Creates a ByteBuffer from a binary string.
     *
     * @param string $value
     *
     * @return \BrianFaust\ByteBuffer\Contracts\Buffable
     */
    public static function fromBinary(string $value): Buffable
    {
        return new static($value);
    }

    /**
     * Creates a ByteBuffer from a hex string.
     *
     * @param string $value
     *
     * @return \BrianFaust\ByteBuffer\Contracts\Buffable
     */
    public static function fromHex(string $value): Buffable
    {
        return new static(hex2bin($value));
    }

    /**
     * Creates a ByteBuffer from a UTF-8 string.
     *
     * @param string $value
     *
     * @return \BrianFaust\ByteBuffer\Contracts\Buffable
     */
    public static function fromUTF8(string $value): Buffable
    {
        return new static(mb_convert_encoding($value, 'UTF-8', 'UTF-8'));
    }

    /**
     * Creates a ByteBuffer from a base64 string.
     *
     * @param string $value
     *
     * @return \BrianFaust\ByteBuffer\Contracts\Buffable
     */
    public static function fromBase64(string $value): Buffable
    {
        return new static(base64_decode($value, true));
    }

    /**
     * Creates a ByteBuffer from an array.
     *
     * @param array $value
     *
     * @return \BrianFaust\ByteBuffer\Contracts\Buffable
     */
    public static function fromArray(array $value): Buffable
    {
        return new static($value);
    }

    /**
     * Get the buffer as a plain string.
     *
     * @param string $value
     * @param string $encoding
     *
     * @return \BrianFaust\ByteBuffer\Contracts\Buffable
     */
    public static function fromString(string $value, string $encoding): Buffable
    {
        switch ($encoding) {
            case 'binary':
                return $this->fromBinary($value, $encoding);
            case 'hex':
                return $this->fromHex($value, $encoding);
            case 'utf8':
                return $this->fromUTF8($value, $encoding);
            case 'base64':
                return $this->fromBase64($value, $encoding);
            default:
                throw new \Exception("The encoding [{$encoding}] is not supported.");
        }
    }
}
