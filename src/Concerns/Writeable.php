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
 * This is the writeable trait.
 *
 * @author Brian Faust <envoyer@pm.me>
 */
trait Writeable
{
    use Writes\Floats,
        Writes\Hex,
        Writes\Integer,
        Writes\Strings,
        Writes\UnsignedInteger;
}
