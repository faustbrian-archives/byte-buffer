<?php

declare(strict_types=1);

/*
 * This file is part of ByteBuffer.
 *
 * (c) Brian Faust <hello@basecode.sh>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BrianFaust\ByteBuffer\Concerns;

/**
 * This is the readable trait.
 *
 * @author Brian Faust <hello@basecode.sh>
 */
trait Readable
{
    use Reads\Floats;
    use Reads\Hex;
    use Reads\Integer;
    use Reads\Strings;
    use Reads\UnsignedInteger;
}
