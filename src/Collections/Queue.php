<?php

namespace Extended\Collections;

/**
 * Queues are defined as a collection of data that has a first-in, first-out
 * methodology.
 */
interface Queue
{
    /**
     * Adds an item to the top of the list
     */
    public function enqueue();

    /**
     * Removes an item from the bottom of the list
     */
    public function dequeue();
}
