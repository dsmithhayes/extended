<?php

namespace Extended\Iterator;

interface ControlIterator extends \Iterator
{
    /**
     * @return bool True if on the first iteration
     */
    public abstract function first();

    /**
     * @return bool True if on the last iteration
     */
    public abstract function last();
}
