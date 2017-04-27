<?php

/**
 * @author Dave Smith-Hayes <me@davesmithhayes.com>
 */

namespace Extended;

use Extended\Iterator\ControlIterator;
use Extended\Iterator\AccessIterator;

/**
 * A basic LinkedList that implemented the ControlIterator interface.
 *
 * Class LinkedList
 * @package Extended
 */
class LinkedList implements ControlIterator, AccessIterator
{
    /**
     * @var int
     *      The key of the list
     */
    protected $key = 0;

    /**
     * @var array
     *      The array that represents the list.
     */
    protected $list;

    /**
     * @param array $list
     *      An array of items for the list
     */
    public function __construct($list = [])
    {
        if (!empty($list)) {
            foreach ($list as $l) {
                $this->add($l);
            }
        } else {
            $this->list = $list;
        }
    }

    /*******************************************
     * Implemented from the Iterator interface *
     *******************************************/

    /**
     * @return mixed
     *      The current item in the list
     */
    public function current()
    {
        return $this->list[$this->key];
    }

    /**
     * Resets the list to the beginning
     *
     * @return void
     */
    public function rewind()
    {
        $this->key = 0;
    }

    /**
     * Moves to the next item in the list
     *
     * @return void
     */
    public function next()
    {
        ++$this->key;
    }

    /**
     * @return bool
     *      True if the current position is a valid list item
     */
    public function valid()
    {
        return isset($this->list[$this->key]);
    }

    /**
     * @return int
     *      The current position in the list
     */
    public function key()
    {
        return $this->key;
    }

    /**
     * Implemented from the ControlIterator interface
     */

    /**
     * @return bool
     *      True if the key is set to the first record
     */
    public function isFirst()
    {
        return ($this->key === 0) ? true : false;
    }

    /**
     * @return bool
     *      True if the key is the last item in the list
     */
    public function isLast()
    {
        return ($this->key === (count($this->list) - 1)) ? true : false;
    }

    /************************************************
    * Implemented from the AccessIterator interface *
    *************************************************/

    /**
     * @return mixed
     *      The first item in the list
     */
    public function getFirst()
    {
        return $this->list[0];
    }

    /**
     * @return mixed
     *      The last item in the list
     */
    public function getLast()
    {
        return $this->list[count($this->list) - 1];
    }

    /**
     * @param int $key
     *      The key of the item in the list to return
     * @return mixed
     *      The item in the list referenced by `$key`
     */
    public function get($key)
    {
        return $this->list[$key];
    }

    /**
     * @param int
     *      The position in the list
     * @param mixed
     *      The item to set
     */
    public function set($key, $value)
    {
        $this->list[$key] = $value;
    }

    /**
     * @param mixed
     *      An item to add to the list
     */
    public function add($value)
    {
        $this->list[] = $value;
    }
}
