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

namespace BrianFaust\Tests\ByteBuffer;

use BrianFaust\ByteBuffer\ByteBuffer;
use PHPUnit\Framework\TestCase;

/**
 * This is the length map test class.
 *
 * @author Brian Faust <envoyer@pm.me>
 * @covers \BrianFaust\ByteBuffer\ByteBuffer
 */
class ByteBufferTest extends TestCase
{
    /** @test */
    public function it_should_initialise_from_array()
    {
        $buffer = ByteBuffer::new(str_split('Hello World'));

        $this->assertInstanceOf(ByteBuffer::class, $buffer);
        $this->assertSame(11, $buffer->capacity());
    }

    /** @test */
    public function it_should_initialise_from_integer()
    {
        $buffer = ByteBuffer::new(11);

        $this->assertInstanceOf(ByteBuffer::class, $buffer);
        $this->assertSame(11, $buffer->capacity());
    }

    /** @test */
    public function it_should_initialise_from_string()
    {
        $buffer = ByteBuffer::new('Hello World');

        $this->assertInstanceOf(ByteBuffer::class, $buffer);
        $this->assertSame(11, $buffer->capacity());
    }

    /** @test */
    public function it_should_allocate_the_given_number_of_bytes()
    {
        $buffer = ByteBuffer::allocate(11);

        $this->assertInstanceOf(ByteBuffer::class, $buffer);
        $this->assertSame(11, $buffer->capacity());
    }
}
