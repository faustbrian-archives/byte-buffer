<?php

namespace BrianFaust\ByteBuffer\Concerns;

trait Exports
{
    public function toArray(int $begin = 0, int $end = 0): array
    {
        return $this->buffer->toArray();
    }

    public function toBase64(int $begin = 0, int $end = 0): string
    {
        return base64_encode($this->toBinary());
    }

    public function toBinary(int $begin = 0, int $end = 0): string
    {
        return implode('', $this->toArray());
    }

    public function toHex(int $begin = 0, int $end = 0): string
    {
        return bin2hex($this->toBinary());
    }

    public function toUTF8(int $begin = 0, int $end = 0): string
    {
        return mb_convert_encoding($this->toBinary(), 'UTF-8', 'UTF-16');
    }

    public function toString(string $encoding, int $begin = 0, int $end = 0): string
    {
        switch ($encoding) {
            case 'utf8':
                return $this->toUTF8($begin, $end);
            case 'base64':
                return $this->toBase64($begin, $end);
            case 'hex':
                return $this->toHex($begin, $end);
            case 'binary':
                return $this->toBinary($begin, $end);
            default:
                throw new \Exception("The encoding [{$encoding}] is not supported.");
        }
    }
}
