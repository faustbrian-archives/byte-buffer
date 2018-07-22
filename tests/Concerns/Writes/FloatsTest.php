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

namespace BrianFaust\Tests\ByteBuffer\Concerns\Writes;

use BrianFaust\ByteBuffer\ByteBuffer;
use PHPUnit\Framework\TestCase;

/**
 * This is the integer writer test class.
 *
 * @author Brian Faust <envoyer@pm.me>
 * @covers \BrianFaust\ByteBuffer\Concerns\Writes\Floats
 */
class FloatsTest extends TestCase
{
    /** @test */
    public function it_should_write_float32()
    {
        $buffer = ByteBuffer::new(1);
        $buffer->writeFloat32(8.0);

        $this->assertSame(4, $buffer->internalSize());
    }

    /** @test */
    public function it_should_write_float64()
    {
        $buffer = ByteBuffer::new(1);
        $buffer->writeFloat64(8.0);

        $this->assertSame(8, $buffer->internalSize());
    }

    /** @test */
    public function it_should_write_double()
    {
        $buffer = ByteBuffer::new(1);
        $buffer->writeDouble(8.0);

        $this->assertSame(8, $buffer->internalSize());
    }
}
