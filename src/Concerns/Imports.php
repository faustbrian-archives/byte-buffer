<?php

namespace BrianFaust\ByteBuffer\Concerns;

trait Imports
{
    public static function fromBase64(string $value): self
    {
        return new static(base64_decode($value, true));
    }

    public static function fromBinary(string $value): self
    {
        return new static($value);
    }

    public static function fromHex(string $value): self
    {
        return new static(hex2bin($value));
    }

    public static function fromUTF8(string $value): self
    {
        return new static(mb_convert_encoding($value, 'UTF-16', 'UTF-8'));
    }
}
