<?php declare(strict_types=1);

/**
 * @author      Dave Smith-Hayes
 * @license     BSD 3.0
 */

namespace Extended\Mutator;

/**
 * Another moderately useless interface, but what the hey! Also useless if you
 * know how to use the `__set()` method.
 */
interface Setter
{
    /**
     * @param mixed $key
     * @param mixed $value
     */
    public function set($key, $value);
}
