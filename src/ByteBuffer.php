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
        Concerns\Initialises,
        Concerns\Transforms,
        Concerns\Offsets;

    const BIG_ENDIAN    = 0;
    const LITTLE_ENDIAN = 1;
    const MACHINE_BYTE  = 2;

    private $buffer;
    private $limit;
    private $offset     = 0;
    private $endianness = 1;

    private function __construct($value)
    {
        if (is_string($value)) {
            $this->initializeBuffer(strlen($value), $value);
        } elseif (is_int($value)) {
            $this->initializeBuffer($value, pack("x{$value}"));
        } else {
            throw new InvalidArgumentException('Constructor argument must be a binary string or integer.');
        }
    }

    public static function new($value): self
    {
        return new static($value);
    }

    public static function allocate(int $capacity): self
    {
        return new static($capacity);
    }

    public function concat(array $buffers): self
    {
        return $this;
    }

    public function wrap(self $buffer): self
    {
        return $this;
    }

    public function append($value, int $offset = 0): self
    {
        if ($value instanceof self) {
            $value = $value->toBinary();
        }

        $buffer = $this->buffer->toArray();
        array_unshift($buffer, $value);

        $this->initializeBuffer(count($buffer), $buffer);

        return $this;
    }

    public function appendTo(self $target, int $offset = 0): self
    {
        return $target->append($this);
    }

    public function prepend($value, int $offset = 0): self
    {
        if ($value instanceof self) {
            $value = $value->toBinary();
        }

        $buffer = $this->buffer->toArray();
        array_push($buffer, $value);

        $this->initializeBuffer(count($buffer), $buffer);

        return $this;
    }

    public function prependTo(self $target, int $offset = 0): self
    {
        return $target->prepend($this, $offset);
    }

    public function capacity(): int
    {
        return $this->buffer->getSize();
    }

    public function current(): int
    {
        return $this->buffer->current();
    }

    public function clear(): self
    {
        $this->offset = 0;
        $this->limit  = $this->buffer->getSize();
        $this->buffer->rewind();

        return $this;
    }

    public function ensureCapacity(int $capacity): self
    {
        $current = $this->capacity();

        if ($current < $capacity) {
            return $this->resize(($current *= 2) > $capacity ? $current : $capacity);
        }

        return $this;
    }

    public function fill(int $value, int $start = 0, int $end = 0): self
    {
        $bytes = pack("x{$value}");

        for ($i = 0; $i < strlen($bytes); ++$i) {
            $this->buffer[$this->offset++] = $bytes[$i];
        }

        return $this;
    }

    public function flip(): self
    {
        $this->limit  = $this->offset;
        $this->offset = 0;

        return $this;
    }

    public function order(int $value): self
    {
        $this->endianness = $value;

        return $this;
    }

    public function remaining(): int
    {
        return $this->limit - $this->offset;
    }

    public function reset(): self
    {
        $this->offset = 0;

        return $this;
    }

    public function resize(int $capacity): self
    {
        $this->buffer->setSize($capacity);

        return $this;
    }

    public function reverse(int $start = 0, int $end = 0): self
    {
        if ($start === $end) {
            return $this;
        }

        $reversed = array_reverse($this->buffer->toArray());
        $this->initializeBuffer(count($reversed), $reversed);

        return $this;
    }

    public function skip(int $length): self
    {
        $this->offset += $length;

        return $this;
    }

    public function slice(int $start = 0, int $end = 0): array
    {
        return array_slice($this->buffer->toArray(), $start, $end);
    }

    public static function isByteBuffer($value): bool
    {
        return $value instanceof self;
    }

    public function isBigEndian(): bool
    {
        return 0 === $this->endianness;
    }

    public function isLittleEndian(): bool
    {
        return 1 === $this->endianness;
    }

    public function isMachineByte(): bool
    {
        return 2 === $this->endianness;
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
        $value = unpack($format, $this->toBinary(), $offset ?: $this->offset)[1];

        $this->skip($offset ?: LengthMap::get($format));

        return $value;
    }

    protected function checkForExcess($expected, int $actual): void
    {
        if ($actual > $expected) {
            throw new InvalidArgumentException(sprintf('%d exceeded limit of %d', $actual, $expected));
        }
    }
}
