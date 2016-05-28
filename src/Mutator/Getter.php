<?php declare(strict_types=1);

/**
 * @author      Dave Smith-Hayes
 * @license     BSD 3.0
 */

namespace Extended\Mutator;

/**
 * These are really unessecary if you understand how the `__get()` methods works.
 */
interface Getter
{
    /**
     * @param string $key The identifier of the property to retrieve
     */
    public function get($key);
}
