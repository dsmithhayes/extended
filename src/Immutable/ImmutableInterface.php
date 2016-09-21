<?php

namespace Extended\Immutable;

interface ImmutableInterface
{
    /**
     * @param string $key
     *      The name of the property to get
     */
    public function get($key);
}
