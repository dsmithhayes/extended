<?php declare(strict_types=1);

/**
 * @author      Dave Smith-Hayes
 * @license     BSD 3.0
 */

namespace Extended\Mutator;

/**
 * Another moderately useless interface, but what the hey!
 */
interface Setter
{
    public function set($key, $value);
}
