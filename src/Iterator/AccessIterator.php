<?php

namespace Extended\Iterator;

use Extended\Mutator\GetInterface;

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
