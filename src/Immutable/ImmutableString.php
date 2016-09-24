<?php

namespace Extended\Immutable;

use Extended\Immutable\Immutable;
use Extended\Exception\ImmutableException;

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
