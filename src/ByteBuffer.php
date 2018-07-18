<?php

namespace BrianFaust\ByteBuffer;

use SplFixedArray;

class ByteBuffer
{
    use Concerns\Reads\Floats,
        Concerns\Reads\Hex,
        Concerns\Reads\Integer,
        Concerns\Reads\Strings,
        Concerns\Reads\UnsignedInteger,
        Concerns\Writes\Floats,
        Concerns\Writes\Hex,
        Concerns\Writes\Integer,
        Concerns\Writes\Strings,
        Concerns\Writes\UnsignedInteger,
        Concerns\Exports,
        Concerns\Imports;

    const BIG_ENDIAN    = 0;
    const LITTLE_ENDIAN = 1;
    const MACHINE_BYTE  = 2;

    private $buffer;
    private $limit;
    private $offset     = 0;
    private $endianness = 1;

    public function __construct($argument)
    {
        //
    }

    public static function allocate(int $capacity): self
    {
        //
    }

    public function concat(array $buffers): self
    {
        //
    }

    public function wrap(self $buffer): self
    {
        //
    }

    public function append(string $value, int $offset = 0): self
    {
        //
    }

    public function appendTo($target, int $offset = 0): self
    {
        //
    }
        }
    public function prepend($value, int $offset = 0): self
    {
        //
    }

    public function prependTo(self $target, int $offset = 0): self
    {
        //
    }

    public function capacity(): int
    {
        //
    }
    public function clear(): self
    {
        //
    }

    public function ensureCapacity(int $capacity): self
    {
        //
    }
    public function fill(int $value, int $start = 0, int $end = 0): self
    {
        //
    }

    public function flip(): self
    {
        //
    }

    public function order(int $value): self
    {
        //
    }

    public function remaining(): int
    {
        //
    }

    public function reset(): self
    {
        //
    }

    public function resize(int $capacity): self
    {
        //
    }

    public function reverse(int $start = 0, int $end = 0): self
    {
        //
    }

    public function skip(int $length): self
    {
        //
    }

    public function slice(int $start = 0, int $end = 0): array
    {
        //
    }

    public static function isByteBuffer($value): bool
    {
        //
    }

    public function isBigEndian(): bool
    {
        //
    }

    public function isLittleEndian(): bool
    {
        //
    }

    public function isMachineByte(): bool
    {
        //
    }

    protected function initializeBuffer(int $length, $content): void
    {
        //
    }

    protected function pack(string $format, $value, int $offset): self
    {
        //
    }

    protected function unpack(string $format, int $offset = 0)
    {
        //
    }

    protected function checkForOverSize(int $expected, int $actual): void
    {
        //
    }
}
