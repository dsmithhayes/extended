<?php

/**
 * @author Dave Smith-Hayes <me@davesmithhayes.com>
 */

namespace Extended\Collections;

/**
 * A Mappable array has the ability to create new arrays that have had the
 * callback function called on each member.
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
