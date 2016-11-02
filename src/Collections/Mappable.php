<?php

namespace Extended\Collections;

/**
 * When a class implements Mappable, they are accepting a callback to apply to
 * each member of an array the object has access to.
 */
interface Mappable
{
    /**
     * @param callable $callback
     *      The callback must return a value that will replace the value in
     *      the array.
     */
    public function map(callable $callback);
}
