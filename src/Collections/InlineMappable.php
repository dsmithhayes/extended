<?php

/**
 * @author Dave Smith-Hayes <me@davesmithhayes.com>
 */

namespace Extended\Collections;

/**
 * An InlineMappable array will apply the callback to its member values.
 *
 * Interface InlineMappable
 * @package Extended\Collections
 */
interface InlineMappable
{
    /**
     * @param callable $callback
     * @return array
     */
    public function inlineMap(callable $callback): array;
}