<?php

namespace Extended;

use Extended\Iterator\ControlIterator;

/**
 * A basic LinkedList that implemented the ControlIterator interface.
 */
class LinkedList implements ControlIterator
{
    /**
     * @var int The key of the list
     */
    private $key = 0;

    /**
     * @var array The array that represents the list.
     */
    private $list = [];

    /**
     * Implemented from the Iterator interface
     */

    /**
     * @return Mixed The current item in the list
     */
    public function current()
    {
        return $this->list[$this->key];
    }

    /**
     * Resets the list to the beginning
     */
    public function rewind()
    {
        $this->key = 0;
    }

    /**
     * Moves to the next item in the list
     */
    public function next()
    {
        ++$this->key;
    }

    /**
     * @return bool True if the current position is a valid list item
     */
    public function valid()
    {
        return isset($this->list[$this->key]);
    }

    /**
     * @return int The current position in the list
     */
    public function key()
    {
        return $this->key;
    }

    /**
     * Implemented from the ControlInterator interface
     */

    /**
     * @return bool
     */
    public function first()
    {
        return ($key === 0) ? true : false;
    }

    /**
     * @return bool
     */
    public function last()
    {
        return ($key === (count($this->list) - 1)) ? true : false;
    }
}
