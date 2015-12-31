<?php

namespace Extended\Collections;

/**
 * Queues are defined as a collection of data that has a first-in, first-out
 * methodology.
 */
interface Queue
{
    /**
     *
     */
    public function enqueue();

    public function dequeue();
}
