<?php declare(strict_types=1);

/**
 * @author      Dave Smith-Hayes
 * @license     BSD 3.0
 */

namespace Extended\Mutator;

/**
 * Thi is really unessecary if you understand how the `__get()` method works.
 */
interface Getter
{
    /**
     * @param mixed $key
     */
    public function get($key);
}
