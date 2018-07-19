<?php

namespace BrianFaust\ByteBuffer\Contracts;

/**
 * This is the readable interface.
 *
 * @author Brian Faust <envoyer@pm.me>
 */
interface Readable
{
    /**
     * Reads an UTF8 encoded string. This is an alias of readUTF8String.
     *
     * @param int $length
     * @param int $offset
     *
     * @return string
     */
    public function readString(int $length, int $offset = 0): string;

    /**
     * Reads an UTF8 encoded string.
     *
     * @param int $length
     * @param int $offset
     *
     * @return string
     */
    public function readUTF8String(int $length, int $offset = 0): string;

    /**
     * Reads a NULL-terminated UTF8 encoded string.
     *
     * @param int $length
     * @param int $offset
     *
     * @return string
     */
    public function readCString(int $length, int $offset = 0): string;

    /**
     * Reads a length as uint32 prefixed UTF8 encoded string.
     *
     * @param int $length
     * @param int $offset
     *
     * @return string
     */
    public function readIString(int $length, int $offset = 0): string;

    /**
     * Reads a length as varint32 prefixed UTF8 encoded string.
     *
     * @param int $length
     * @param int $offset
     *
     * @return string
     */
    public function readVString(int $length, int $offset = 0): string;

    /**
     * Reads a 32bit float.
     *
     * @param int $offset
     *
     * @return float
     */
    public function readFloat32(int $offset = 0): float;

    /**
     * Reads a 64bit float.
     *
     * @param int $offset
     *
     * @return float
     */
    public function readFloat64(int $offset = 0): float;

    /**
     * Reads a 64bit float. This is an alias of readFloat64.
     *
     * @param int $offset
     *
     * @return float
     */
    public function readDouble(int $offset = 0): float;

    /**
     * Reads an 8bit signed integer.
     *
     * @param int $offset
     *
     * @return int
     */
    public function readInt8(int $offset = 0): int;

    /**
     * Reads an 16bit signed integer.
     *
     * @param int $offset
     *
     * @return int
     */
    public function readInt16(int $offset = 0): int;

    /**
     * Reads an 32bit signed integer.
     *
     * @param int $offset
     *
     * @return int
     */
    public function readInt32(int $offset = 0): int;

    /**
     * Reads an 64bit signed integer.
     *
     * @param int $offset
     *
     * @return int
     */
    public function readInt64(int $offset = 0): int;

    /**
     * Reads an 8bit signed integer. This is an alias of readInt8.
     *
     * @param int $offset
     *
     * @return int
     */
    public function readByte(int $offset = 0): int;

    /**
     * Reads an 16bit signed integer. This is an alias of readInt16.
     *
     * @param int $offset
     *
     * @return int
     */
    public function readShort(int $offset = 0): int;

    /**
     * Reads an 32bit signed integer. This is an alias of readInt32.
     *
     * @param int $offset
     *
     * @return int
     */
    public function readInt(int $offset = 0): int;

    /**
     * Reads an 64bit signed integer. This is an alias of readInt64.
     *
     * @param int $offset
     *
     * @return int
     */
    public function readLong(int $offset = 0): int;

    /**
     * Reads an 8bit unsigned integer.
     *
     * @param int $offset
     *
     * @return int
     */
    public function readUInt8(int $offset = 0): int;

    /**
     * Reads an 16bit unsigned integer.
     *
     * @param int $offset
     *
     * @return int
     */
    public function readUInt16(int $offset = 0): int;

    /**
     * Reads an 32bit unsigned integer.
     *
     * @param int $offset
     *
     * @return int
     */
    public function readUInt32(int $offset = 0): int;

    /**
     * Reads an 64bit unsigned integer.
     *
     * @param int $offset
     *
     * @return int
     */
    public function readUInt64(int $offset = 0): int;

    /**
     * Reads a 8bit unsigned integer. This is an alias of readUInt8.
     *
     * @param int $offset
     *
     * @return int
     */
    public function readUByte(int $offset = 0): int;

    /**
     * Reads a 16bit unsigned integer. This is an alias of readUInt16.
     *
     * @param int $offset
     *
     * @return int
     */
    public function readUShort(int $offset = 0): int;

    /**
     * Reads a 32bit unsigned integer. This is an alias of readUInt32.
     *
     * @param int $offset
     *
     * @return int
     */
    public function readUInt(int $offset = 0): int;

    /**
     * Reads a 64bit unsigned integer. This is an alias of readUInt64.
     *
     * @param int $offset
     *
     * @return int
     */
    public function readULong(int $offset = 0): int;
}
