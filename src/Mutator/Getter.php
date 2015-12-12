<?php

namespace Extended\Mutator;

/**
 *
 */
interface Getter
{
    /**
     * @param string $key The identifier of the property to retrieve
     */
    public function get($key);
}
