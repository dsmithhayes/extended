<?php

namespace Extended\Mutable;

/**
 * Another moderately useless interface, but what the hey!
 */
interface SetInterface
{
    /**
     * @param mixed $key
     *      The key to set
     * @param mixed $value
     *      The value to set referenced by `$key`
     */
    public function set($key, $value);
}
