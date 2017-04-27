<?php

/**
 * @author Dave Smith-Hayes <me@davesmithhayes.com>
 */

namespace Extended\Immutable;

use Extended\Immutable\Immutable;
use Extended\Exception\ImmutableException;

/**
 * Class ImmutableString
 * @package Extended\Immutable
 */
class ImmutableString extends Immutable
{
    public function __contruct($key, $value)
    {
        if (!is_string($key) || !is_string($value)) {
            throw new ImmutableException('Key and value not a string.');
        }

        $temp[$key] = $value;
    }
}
