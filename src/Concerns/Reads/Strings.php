<?php

namespace BrianFaust\ByteBuffer\Concerns\Reads;

trait Strings
{
    /**
     * Reads an UTF8 encoded string. This is an alias of readUTF8String.
     *
     * @param int $length
     * @param int $offset
     *
     * @return string
     */
    public function readString(int $length, int $offset = 0): string
    {
        return $this->readUTF8String($length, $offset);
    }

    /**
     * Reads an UTF8 encoded string.
     *
     * @param int $length
     * @param int $offset
     *
     * @return string
     */
    public function readUTF8String(int $length, int $offset = 0): string
    {
        return utf8_decode($this->unpack("a{$length}", $offset));
    }

    /**
     * Reads a NULL-terminated UTF8 encoded string.
     *
     * @param int $offset
     *
     * @return string
     */
    public function readCString(int $offset = 0): string
    {
        return $this;
    }

    /**
     * Reads a length as uint32 prefixed UTF8 encoded string.
     *
     * @param int $offset
     *
     * @return string
     */
    public function readIString(int $offset = 0): string
    {
        return $this;
    }

    /**
     * Reads a length as varint32 prefixed UTF8 encoded string.
     *
     * @param int $offset
     *
     * @return string
     */
    public function readVString(int $offset = 0): string
    {
        return $this;
    }
}
