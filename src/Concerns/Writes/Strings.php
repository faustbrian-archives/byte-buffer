<?php

namespace BrianFaust\ByteBuffer\Concerns\Writes;

trait Strings
{
    public function writeBytes($value, int $offset = 0): self
    {
        return $this->append($value, $offset);
    }

    public function writeCString(string $value, int $offset = 0): self
    {
        return $this;
    }

    public function writeIString(string $value, int $offset = 0): self
    {
        return $this;
    }

    public function writeString(string $value, int $offset = 0): self
    {
        $length = strlen($value);

        return $this->pack("a{$length}", $value, $offset, $length);
    }

    public function writeVString(string $value, int $offset = 0): self
    {
        return $this;
    }
}
