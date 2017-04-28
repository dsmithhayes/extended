<?php

/**
 * @author Dave Smith-Hayes <me@davesmithhayes.com>
 */

namespace Extended;

use Extended\BasicQueue;

class AdvancedQueue extends BasicQueue implements \Iterator
{
    public function current()
    {
        return $this->dequeue();
    }

    public function key()
    {
        return 0;
    }

    public function next()
    {
        return;
    }

    public function rewind()
    {
        return;
    }

    public function valid()
    {
        return isset($this->data[0]);
    }
}