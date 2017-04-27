<?php

/**
 * @author Dave Smith-Hayes <me@davesmithhayes.com>
 */

namespace Extended\Mutable;

/**
 * Another moderately useless interface, but what the hey!
 *
 * Interface SetInterface
 * @package Extended\Mutable
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
