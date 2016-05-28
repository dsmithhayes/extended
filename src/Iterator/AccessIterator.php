<?php declare(strict_types=1);

/**
 * @author      Dave Smith-Hayes
 * @license     BSD 3.0
 */

namespace Extended\Iterator;

use Extended\Mutator\Getter;

interface AccessIterator extends \Iterator, Getter
{
    /**
     * @return mixed The first element of what's being iterated
     */
    public function getFirst();

    /**
     * @return mixed The last element of what's being iterated
     */
    public function getLast();
}
