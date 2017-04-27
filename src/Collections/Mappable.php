<?php

namespace Extended\Collections;

/**
 * When a class implements Mappable, they are accepting a callback to apply to
 * each member of an array the object has access to.
 *
 * Interface Mappable
 * @package Extended\Collections
 */
interface Mappable
{
    /**
     * @param callable $callback
     *      The callback must return a value that will replace the value in
     *      the array.
     * @return array
     */
    public function map(callable $callback): array;
}
