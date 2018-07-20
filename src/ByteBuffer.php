<?php

declare(strict_types=1);

/*
 * This file is part of ByteBuffer.
 *
 * (c) Brian Faust <envoyer@pm.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BrianFaust\ByteBuffer;

use BrianFaust\ByteBuffer\Contracts\Buffable;
use InvalidArgumentException;

/**
 * This is the byte buffer class.
 *
 * @author Brian Faust <envoyer@pm.me>
 */
class ByteBuffer implements Contracts\Buffable,
                            Contracts\Initialisable,
                            Contracts\Offsetable,
                            Contracts\Positionable,
                            Contracts\Readable,
                            Contracts\Sizeable,
                            Contracts\Transformable,
                            Contracts\Writeable
{
    use Concerns\Initialisable,
        Concerns\Offsetable,
        Concerns\Positionable,
        Concerns\Readable,
        Concerns\Sizeable,
        Concerns\Transformable,
        Concerns\Writeable;

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
     * Absolute length of the contained data.
     *
     * @var int
     */
    private $length;

    /**
     * Whether to use big endian, little endian or machine byte order.
     *
     * @var int
     */
    private $order = 1;

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
     * @return \BrianFaust\ByteBuffer\Contracts\Buffable
     */
    public static function new($value): Buffable
    {
        return new static($value);
    }

    /**
     * Allocates a new ByteBuffer backed by a buffer of the specified capacity.
     *
     * @param int $capacity
     *
     * @return \BrianFaust\ByteBuffer\Contracts\Buffable
     */
    public static function allocate(int $capacity): Buffable
    {
        return new static($capacity);
    }

    /**
     * Initialise a new buffer from the given content.
     *
     * @param int              $length
     * @param string|int|array $content
     */
    public function initializeBuffer(int $length, $content): void
    {
        for ($i = 0; $i < $length; ++$i) {
            $this->buffer[$i] = $content[$i];
        }

        $this->length = $length;
    }

    /**
     * Pack data into a binary string.
     *
     * @param string     $format
     * @param string|int $value
     * @param int        $offset
     *
     * @return \BrianFaust\ByteBuffer\Contracts\Buffable
     */
    public function pack(string $format, $value, int $offset): Buffable
    {
        $this->skip($offset);

        $bytes = pack($format, $value);

        for ($i = 0; $i < strlen($bytes); ++$i) {
            $this->buffer[$this->offset++] = $bytes[$i];
        }

        return $this;
    }

    /**
     * Unpack data from a binary string.
     *
     * @param string $format
     * @param int    $offset
     *
     * @return string|int
     */
    public function unpack(string $format, int $offset = 0)
    {
        $this->skip($offset);

        $value = unpack($format, $this->toBinary(), $this->offset)[1];

        $this->skip(LengthMap::get($format));

        return $value;
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
        return $this->offsetGet($offset);
    }

    /**
     * Concatenates multiple ByteBuffers into one.
     *
     * @param array $buffers
     *
     * @return \BrianFaust\ByteBuffer\Contracts\Buffable
     */
    public static function concat(...$buffers): Buffable
    {
        $initial = $buffers[0];

        foreach (array_slice($buffers, 1) as $buffer) {
            $initial->append($buffer);
        }

        return $initial;
    }

    /**
     * Appends some data to this ByteBuffer.
     *
     * @param mixed $value
     * @param int   $offset
     *
     * @return \BrianFaust\ByteBuffer\Contracts\Buffable
     */
    public function append($value, int $offset = 0): Buffable
    {
        if ($value instanceof self) {
            $value = $value->toArray($offset);
        }

        if (is_string($value)) {
            $value = str_split($value);
        }

        $buffer = array_merge($this->buffer, $value);

        $this->initializeBuffer(count($buffer), $buffer);

        return $this;
    }

    /**
     * Appends this ByteBuffers contents to another ByteBuffer.
     *
     * @param \BrianFaust\ByteBuffer\Contracts\Buffable $buffer
     * @param int                                       $offset
     *
     * @return \BrianFaust\ByteBuffer\Contracts\Buffable
     */
    public function appendTo(self $buffer, int $offset = 0): Buffable
    {
        return $buffer->append($this);
    }

    /**
     * Prepends some data to this ByteBuffer.
     *
     * @param mixed $value
     * @param int   $offset
     *
     * @return \BrianFaust\ByteBuffer\Contracts\Buffable
     */
    public function prepend($value, int $offset = 0): Buffable
    {
        if ($value instanceof self) {
            $value = $value->toArray($offset);
        }

        if (is_string($value)) {
            $value = str_split($value);
        }

        $buffer = $this->buffer;

        foreach (array_reverse($value) as $item) {
            array_unshift($buffer, $item);
        }

        $this->initializeBuffer(count($buffer), $buffer);

        return $this;
    }

    /**
     * Prepends this ByteBuffers contents to another ByteBuffer.
     *
     * @param \BrianFaust\ByteBuffer\Contracts\Buffable $buffer
     * @param int                                       $offset
     *
     * @return \BrianFaust\ByteBuffer\Contracts\Buffable
     */
    public function prependTo(self $buffer, int $offset = 0): Buffable
    {
        return $buffer->prepend($this, $offset);
    }

    /**
     * Overwrites this ByteBuffers contents with the specified value.
     *
     * @param int $length
     * @param int $start
     *
     * @return \BrianFaust\ByteBuffer\Contracts\Buffable
     */
    public function fill(int $length, int $start = 0): Buffable
    {
        $this->buffer = array_fill($start, $length, pack('x'));

        $this->skip($length);

        return $this;
    }

    /**
     * Makes this ByteBuffer ready for a new sequence of write or relative read operations.
     *
     * @return \BrianFaust\ByteBuffer\Contracts\Buffable
     */
    public function flip(): Buffable
    {
        $this->length = $this->offset;
        $this->offset = 0;

        return $this;
    }

    /**
     * Sets the byte order.
     *
     * @param int $value
     *
     * @return \BrianFaust\ByteBuffer\Contracts\Buffable
     */
    public function order(int $value): Buffable
    {
        $this->order = $value;

        return $this;
    }

    /**
     * Reverses this ByteBuffers contents.
     *
     * @param int $start
     * @param int $length
     *
     * @return \BrianFaust\ByteBuffer\Contracts\Buffable
     */
    public function reverse(int $start = 0, int $length = 0): Buffable
    {
        $reversed = array_reverse($this->slice($start, $length));

        $this->initializeBuffer(count($reversed), $reversed);

        return $this;
    }

    /**
     * Extract a slice of the ByteBuffer.
     *
     * @param int $offset
     * @param int $length
     *
     * @return array
     */
    public function slice(int $offset, int $length): array
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
        return 0 === $this->order;
    }

    /**
     * Tests if the byte order is set to little endian.
     *
     * @return bool
     */
    public function isLittleEndian(): bool
    {
        return 1 === $this->order;
    }

    /**
     * Tests if the byte order is set to machine byte.
     *
     * @return bool
     */
    public function isMachineByte(): bool
    {
        return 2 === $this->order;
    }

    /**
     * Check if the actual value exceeds the expected value in size.
     *
     * @param int $expected
     * @param int $actual
     */
    public function checkForExcess($expected, $actual): void
    {
        if ($actual > $expected) {
            throw new InvalidArgumentException("{$actual} exceeded length of {$expected}");
        }
    }
}
