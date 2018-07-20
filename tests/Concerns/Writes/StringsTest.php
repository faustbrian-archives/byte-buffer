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
 * This is the string writer test class.
 *
 * @author Brian Faust <envoyer@pm.me>
 * @covers \BrianFaust\ByteBuffer\Concerns\Writes\Strings
 */
class StringsTest extends TestCase
{
    /** @test */
    public function it_should_write_string()
    {
        $buffer = ByteBuffer::new(1);
        $buffer->writeString('Hello World');

        $this->assertSame(11, $buffer->capacity());
    }

    /** @test */
    public function it_should_write_utf8_string()
    {
        $buffer = ByteBuffer::new(1);
        $buffer->writeUTF8String('Hello World 😄');

        $this->assertSame(20, $buffer->capacity());
    }

    /** @test */
    public function it_should_write_c_string()
    {
        $buffer = ByteBuffer::new(1);
        $buffer->writeCString('Hello World ');

        $this->assertSame(12, $buffer->capacity());
    }
}
