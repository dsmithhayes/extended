<?php

/**
 * @author Dave Smith-Hayes <me@davesmithhayes.com>
 */

namespace Extended\Iterator;

use Extended\Mutable\GetInterface;

/**
 * Interface AccessIterator
 * @package Extended\Iterator
 */
interface AccessIterator extends \Iterator, GetInterface
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
