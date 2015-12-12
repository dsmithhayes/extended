<?php

namespace Extended\Iterator;

interface AccessIterator extends \Iterator
{
    /**
     * @return mixed The first element of what's being iterated
     */
    public function getFirst();
    
    /**
     * @return mixed The last element of what's being iterated
     */
    public function getLast();
    
    /**
     * @param  mixed The key of the element
     * @return mixed The element at $key
     */
    public function get($key);
}

