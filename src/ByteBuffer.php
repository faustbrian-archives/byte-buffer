<?php

namespace BrianFaust\ByteBuffer;

use SplFixedArray;
use InvalidArgumentException;

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

    public function __construct($value)
    {
        if (is_string($value)) {
            $this->initializeBuffer(strlen($value), $value);
        } elseif (is_int($value)) {
            $this->initializeBuffer($value, pack("x{$value}"));
        } else {
            throw new InvalidArgumentException('Constructor argument must be a binary string or integer.');
        }
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
        $this->buffer = new SplFixedArray($length);

        for ($i = 0; $i < $length; ++$i) {
            $this->buffer[$i] = $content[$i];
        }

        $this->limit = $length;
    }

    protected function pack(string $format, $value, int $offset): self
    {
        $bytes = pack($format, $value);

        for ($i = 0; $i < strlen($bytes); ++$i) {
            $this->buffer[$this->offset++] = $bytes[$i];
        }

        return $this;
    }

    protected function unpack(string $format, int $offset = 0)
    {
        $value = unpack($format, $this->toBinary(), $this->offset)[1];

        $this->skip($offset ?: LengthMap::get($format));

        return $value;
    }

    protected function exceeds($expected, int $actual): void
    {
        if ($actual > $expected) {
            throw new InvalidArgumentException(sprintf('%d exceeded limit of %d', $actual, $expected));
        }
    }
}
