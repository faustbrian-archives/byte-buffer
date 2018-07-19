<?php

namespace BrianFaust\ByteBuffer\Concerns\Writes;

trait Strings
{
    /**
     * Writes a payload of bytes. This is an alias of append.
     *
     * @param string $value
     * @param int    $offset
     *
     * @return \BrianFaust\ByteBuffer\ByteBuffer
     */
    public function writeBytes(string $value, int $offset = 0): self
    {
        return $this->append($value, $offset);
    }

    /**
     * Writes a NULL-terminated UTF8 encoded string.
     *
     * @param string $value
     * @param int    $offset
     *
     * @return \BrianFaust\ByteBuffer\ByteBuffer
     */
    public function writeCString(string $value, int $offset = 0): self
    {
        return $this;
    }

    /**
     * Writes a length as uint32 prefixed UTF8 encoded string.
     *
     * @param string $value
     * @param int    $offset
     *
     * @return \BrianFaust\ByteBuffer\ByteBuffer
     */
    public function writeIString(string $value, int $offset = 0): self
    {
        return $this;
    }

    /**
     * Writes an UTF8 encoded string. This is an alias of writeUTF8String.
     *
     * @param string $value
     * @param int    $offset
     *
     * @return \BrianFaust\ByteBuffer\ByteBuffer
     */
    public function writeString(string $value, int $offset = 0): self
    {
        $length = strlen($value);

        return $this->pack("a{$length}", $value, $offset, $length);
    }

    /**
     * Writes an UTF8 encoded string.
     *
     * @param string $value
     * @param int    $offset
     *
     * @return \BrianFaust\ByteBuffer\ByteBuffer
     */
    public function writeUTF8String(string $value, int $offset = 0): self
    {
        return $this;
    }

    /**
     * Writes a length as varint32 prefixed UTF8 encoded string.
     *
     * @param string $value
     * @param int    $offset
     *
     * @return \BrianFaust\ByteBuffer\ByteBuffer
     */
    public function writeVString(string $value, int $offset = 0): self
    {
        return $this;
    }
}
