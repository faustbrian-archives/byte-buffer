<?php

namespace BrianFaust\ByteBuffer;

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

    /**
     * Big endian constant that can be used instead of its numerical value.
     */
    const BIG_ENDIAN    = 0;

    /**
     * Little endian constant that can be used instead of its numerical value.
     */
    const LITTLE_ENDIAN = 1;

    /**
     * Machine byte constant that can be used instead of its numerical value.
     */
    const MACHINE_BYTE  = 2;

    /**
     * Backing ArrayBuffer.
     *
     * @var array
     */
    private $buffer = [];

    /**
     * Absolute read/write offset.
     *
     * @var int
     */
    private $offset = 0;

    /**
     * Absolute limit of the contained data.
     *
     * @var int
     */
    private $limit;

    /**
     * Whether to use big endian, little endian or machine byte order.
     *
     * @var int
     */
    private $endianness = 1;

    /**
     * Constructs a new ByteBuffer.
     *
     * @param array|string|int $value
     */
    private function __construct($value)
    {
        switch (gettype($value)) {
            case 'array':
                $this->initializeBuffer(count($value), $value);
                break;

            case 'integer':
                $this->initializeBuffer($value, pack("x{$value}"));
                break;

            case 'string':
                $this->initializeBuffer(strlen($value), $value);
                break;

            default:
                throw new InvalidArgumentException('Constructor argument must be a binary string or integer.');
                break;
        }
    }

    /**
     * Handle dynamic calls to the container to set attributes.
     *
     * @param string $method
     * @param array  $parameters
     *
     * @return $this
     */
    public function __call(string $method, array $parameters)
    {
        $this->attributes[$method] = count($parameters) > 0 ? $parameters[0] : true;

        return $this;
    }

    /**
     * Dynamically retrieve a value from the buffer.
     *
     * @param int $offset
     *
     * @return mixed
     */
    public function __get(int $offset)
    {
        return $this->offsetGet($offset);
    }

    /**
     * Dynamically set a value in the buffer.
     *
     * @param int   $offset
     * @param mixed $value
     */
    public function __set(int $offset, $value)
    {
        $this->offsetSet($offset, $value);
    }

    /**
     * Dynamically check if a value in the buffer is set.
     *
     * @param int $offset
     *
     * @return bool
     */
    public function __isset(int $offset)
    {
        return $this->offsetExists($offset);
    }

    /**
     * Dynamically unset a value in the buffer.
     *
     * @param int $offset
     */
    public function __unset(int $offset)
    {
        $this->offsetUnset($offset);
    }

    /**
     * Allocates a new ByteBuffer backed by a buffer of the specified capacity.
     *
     * @param array|string|int $value
     *
     * @return static
     */
    public static function new($value): self
    {
        return new static($value);
    }

    /**
     * Allocates a new ByteBuffer backed by a buffer of the specified capacity.
     *
     * @param int $capacity
     *
     * @return static
     */
    public static function allocate(int $capacity): self
    {
        return new static($capacity);
    }

    /**
     * Get a value from the buffer.
     *
     * @param int $offset
     *
     * @return mixed
     */
    public function get(int $offset)
    {
        return $this->attributes[$offset];
    }

    public static function concat(...$buffers): self
    {
        $initial = $buffers[0];

        foreach (array_slice($buffers, 1) as $buffer) {
            $initial->append($buffer);
        }

        return $initial;
    }

    public function wrap(self $buffer): self
    {
        return $this;
    }

    /**
     * Appends some data to this ByteBuffer.
     *
     * @param mixed $value
     * @param int   $offset
     *
     * @return \BrianFaust\ByteBuffer\ByteBuffer
     */
    public function append($value, int $offset = 0): self
    {
        if ($value instanceof self) {
            $value = $value->toArray($offset);
        }

        $buffer = array_merge($this->buffer, $value);

        $this->initializeBuffer(count($buffer), $buffer);

        return $this;
    }

    /**
     * Appends this ByteBuffer's contents to another ByteBuffer.
     *
     * @param \BrianFaust\ByteBuffer\ByteBuffer $target
     * @param int                               $offset
     *
     * @return \BrianFaust\ByteBuffer\ByteBuffer
     */
    public function appendTo(self $target, int $offset = 0): self
    {
        return $target->append($this);
    }

    /**
     * Prepends some data to this ByteBuffer.
     *
     * @param mixed $value
     * @param int   $offset
     *
     * @return \BrianFaust\ByteBuffer\ByteBuffer
     */
    public function prepend($value, int $offset = 0): self
    {
        if ($value instanceof self) {
            $value = $value->toArray($offset);
        }

        $buffer = $this->buffer;

        foreach (array_reverse($value) as $item) {
            array_unshift($buffer, $item);
        }

        $this->initializeBuffer(count($buffer), $buffer);

        return $this;
    }

    /**
     * Prepends this ByteBuffer's contents to another ByteBuffer.
     *
     * @param \BrianFaust\ByteBuffer\ByteBuffer $target
     * @param int                               $offset
     *
     * @return \BrianFaust\ByteBuffer\ByteBuffer
     */
    public function prependTo(self $target, int $offset = 0): self
    {
        return $target->prepend($this, $offset);
    }

    /**
     * Gets the capacity of this ByteBuffer's backing buffer.
     *
     * @return int
     */
    public function capacity(): int
    {
        return count($this->buffer);
    }

    /**
     * Gets the absolute read/write offset.
     *
     * @return int
     */
    public function current(): int
    {
        return $this->offset;
    }

    /**
     * Clears this ByteBuffer's offsets.
     *
     * @return \BrianFaust\ByteBuffer\ByteBuffer
     */
    public function clear(): self
    {
        $this->offset = 0;
        $this->limit  = count($this->buffer);

        return $this;
    }

    /**
     * Makes sure that this ByteBuffer is backed by a buffer of at least the specified capacity.
     *
     * @param int $capacity
     *
     * @return \BrianFaust\ByteBuffer\ByteBuffer
     */
    public function ensureCapacity(int $capacity): self
    {
        $current = $this->capacity();

        if ($current < $capacity) {
            return $this->resize(($current *= 2) > $capacity ? $current : $capacity);
        }

        return $this;
    }

    /**
     * Overwrites this ByteBuffer's contents with the specified value.
     *
     * @param int $length
     * @param int $start
     *
     * @return \BrianFaust\ByteBuffer\ByteBuffer
     */
    public function fill(int $length, int $start = 0): self
    {
        $this->buffer = array_fill($start, $length, pack('x'));

        $this->skip($length);

        return $this;
    }

    /**
     * Makes this ByteBuffer ready for a new sequence of write or relative read operations.
     *
     * @return \BrianFaust\ByteBuffer\ByteBuffer
     */
    public function flip(): self
    {
        $this->limit  = $this->offset;
        $this->offset = 0;

        return $this;
    }

    /**
     * Sets the byte order.
     *
     * @param int $value
     *
     * @return \BrianFaust\ByteBuffer\ByteBuffer
     */
    public function order(int $value): self
    {
        $this->endianness = $value;

        return $this;
    }

    /**
     * Gets the number of remaining readable bytes.
     *
     * @return int
     */
    public function remaining(): int
    {
        return $this->limit - $this->offset;
    }

    /**
     * Resets this ByteBuffers offset.
     *
     * @return \BrianFaust\ByteBuffer\ByteBuffer
     */
    public function reset(): self
    {
        $this->offset = 0;

        return $this;
    }

    /**
     * Resizes this ByteBuffer to be backed by a buffer of at least the given capacity.
     *
     * @param int $capacity
     *
     * @return \BrianFaust\ByteBuffer\ByteBuffer
     */
    public function resize(int $capacity): self
    {
        $this->buffer = $this->slice(0, $capacity);
        $this->limit  = $capacity;

        return $this;
    }

    /**
     * Reverses this ByteBuffer's contents.
     *
     * @param int $start
     * @param int $length
     *
     * @return \BrianFaust\ByteBuffer\ByteBuffer
     */
    public function reverse(int $start = 0, int $length = 0): self
    {
        if ($start === $length) {
            return $this;
        }

        $reversed = array_reverse($this->slice($this->buffer, $start, $length));

        $this->initializeBuffer(count($reversed), $reversed);

        return $this;
    }

    /**
     * Skips the next `length` bytes. May also be negative to move the offset back.
     *
     * @param int $length
     *
     * @return \BrianFaust\ByteBuffer\ByteBuffer
     */
    public function skip(int $length): self
    {
        $this->offset += $length;

        return $this;
    }

    /**
     * Extract a slice of the ByteBuffer.
     *
     * @param int| $offset
     * @param int| $length
     *
     * @return array
     */
    public function slice(int $offset = 0, int $length = 0): array
    {
        if ($length <= 0) {
            return $this->buffer;
        }

        return array_slice($this->buffer, $offset, $length);
    }

    /**
     * Tests if the given value is a ByteBuffer.
     *
     * @param mixed $value
     *
     * @return bool
     */
    public static function isByteBuffer($value): bool
    {
        return $value instanceof self;
    }

    /**
     * Tests if the byte order is set to big endian.
     *
     * @return bool
     */
    public function isBigEndian(): bool
    {
        return 0 === $this->endianness;
    }

    /**
     * Tests if the byte order is set to little endian.
     *
     * @return bool
     */
    public function isLittleEndian(): bool
    {
        return 1 === $this->endianness;
    }

    /**
     * Tests if the byte order is set to machine byte.
     *
     * @return bool
     */
    public function isMachineByte(): bool
    {
        return 2 === $this->endianness;
    }

    protected function initializeBuffer(int $length, $content): void
    {
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
        $value = unpack($format, $this->toBinary($offset), $offset ?: $this->offset)[1];

        $this->skip($offset ?: LengthMap::get($format));

        return $value;
    }

    protected function checkForExcess($expected, int $actual): void
    {
        if ($actual > $expected) {
            throw new InvalidArgumentException("{$actual} exceeded limit of {$expected}");
        }
    }
}
