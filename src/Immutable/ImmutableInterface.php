<?php

namespace Extended\Immutable;

/**
 * When something is immutable, it means that its values cannot be altered. PHP
 * has a pesky problem of not being very immutable, so things can change
 * without you even realizing it. The idea of this interface, and the subsequent
 * class, is that the values cannot be altered.
 */
interface ImmutableInterface
{
    /**
     * @param string $key
     *      The name of the property to get
     */
    public function get($key);
}
