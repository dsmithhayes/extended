<?php

/**
 * @author Dave Smith-Hayes <me@davesmithhayes.com>
 */

namespace Extended\Mutable;

/**
 * Interface GetInterface
 * @package Extended\Mutable
 */
interface GetInterface
{
    /**
     * @param string $key
     *      The reference to the property to retrieve
     */
    public function get($key);
}
