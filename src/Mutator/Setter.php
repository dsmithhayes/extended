<?php

namespace Extended\Mutator;

/**
 * Another moderately useless interface, but what the hey!
 */
interface Setter
{
    /**
     * @param mixed $key
     *      The key to set
     * @param mixed $value
     *      The value to set referenced by `$key`
     */
    public function set($key, $value);
}
