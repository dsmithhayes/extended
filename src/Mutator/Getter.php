<?php

namespace Extended\Mutator;

/**
 * These are really unessecary if you understand how the `__get()` methods works.
 */
interface Getter
{
    /**
     * @param string $key The identifier of the property to retrieve
     */
    public function get($key);
}
