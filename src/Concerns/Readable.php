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

namespace BrianFaust\ByteBuffer\Concerns;

/**
 * This is the readable trait.
 *
 * @author Brian Faust <envoyer@pm.me>
 */
trait Readable
{
    use Reads\Floats,
        Reads\Hex,
        Reads\Integer,
        Reads\Strings,
        Reads\UnsignedInteger;
}
