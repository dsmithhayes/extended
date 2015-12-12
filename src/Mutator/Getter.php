<?php

namespace Extended\Mutator;

/**
 * This interface defines just one method, `get()`, which is used to return a
 * property of a class.
 */
trait Getter
{
    /**
     * @param string $propertyName The identifier of the property to retrieve
     */
    public function get($propertyName)
    {
        return $this->{$propertyName};
    }
}
