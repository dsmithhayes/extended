<?php

namespace Extended\Mutable;

interface GetInterface
{
    /**
     * @param string $key
     *      The reference to the property to retrieve
     */
    public function get($key);
}
