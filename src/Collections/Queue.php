<?php

/**
 * @author Dave Smith-Hayes <me@davesmithhayes.com>
 */

namespace Extended\Collections;

/**
 * Queues are defined as a collection of data that has a first-in, first-out
 * methodology.
 *
 * Interface Queue
 * @package Extended\Collections
 */
interface Queue
{
    /**
     * Adds an item to the top of the list.
     *
     * @param mixed $item
     *      Places $item into the queue
     */
    public function enqueue($item);

    /**
     * Removes an item from the bottom of the list.
     *
     * @return mixed
     *      The first item in the queue
     */
    public function dequeue();
}
