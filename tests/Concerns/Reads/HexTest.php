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

namespace BrianFaust\Tests\ByteBuffer\Concerns\Reads;

use BrianFaust\ByteBuffer\ByteBuffer;
use PHPUnit\Framework\TestCase;

/**
 * This is the hex reader test class.
 *
 * @author Brian Faust <envoyer@pm.me>
 * @covers \BrianFaust\ByteBuffer\Concerns\Reads\Hex
 */
class HexTest extends TestCase
{
    /** @test */
    public function it_should_read_hex()
    {
        $buffer = ByteBuffer::new(0);
        $buffer->writeBytes('48656c6c6f20576f726c64');

        $this->assertSame(22, $buffer->capacity());
        $this->assertSame(bin2hex('48656c6c6f20576f726c64'), $buffer->readHex(44));
    }

    /** @test */
    public function it_should_read_hex_as_string()
    {
        $buffer = ByteBuffer::new(0);
        $buffer->writeBytes('48656c6c6f20576f726c64');

        $this->assertSame(22, $buffer->capacity());
        $this->assertSame('Hello World', $buffer->readHexString(44));
    }
}
