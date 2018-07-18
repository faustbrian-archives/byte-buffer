<?php

namespace BrianFaust\ByteBuffer\Concerns;

trait Transforms
{
    public function toArray(int $start = 0, int $end = 0): array
    {
        return $this->buffer->toArray();
    }

    public function toBase64(int $start = 0, int $end = 0): string
    {
        return base64_encode($this->toBinary());
    }

    public function toBinary(int $start = 0, int $end = 0): string
    {
        return implode('', $this->toArray());
    }

    public function toHex(int $start = 0, int $end = 0): string
    {
        return bin2hex($this->toBinary());
    }

    public function toUTF8(int $start = 0, int $end = 0): string
    {
        return mb_convert_encoding($this->toBinary(), 'UTF-8', 'UTF-16');
    }

    public function toString(string $encoding, int $start = 0, int $end = 0): string
    {
        switch ($encoding) {
            case 'utf8':
                return $this->toUTF8($start, $end);
            case 'base64':
                return $this->toBase64($start, $end);
            case 'hex':
                return $this->toHex($start, $end);
            case 'binary':
                return $this->toBinary($start, $end);
            default:
                throw new \Exception("The encoding [{$encoding}] is not supported.");
        }
    }
}
