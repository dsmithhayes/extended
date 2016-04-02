<?php

namespace Extended\Iterator;

/**
 * The ControlInterator has two methods that check where where in the iteration
 * the computations currently are.
 */
interface ControlIterator extends \Iterator
{
    /**
     * @return bool
     *      True if on the first iteration
     */
    public function isFirst();

    /**
     * @return bool
     *      True if on the last iteration
     */
    public function isLast();
}
