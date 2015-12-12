<?php

namespace Extended\Mutator;

trait Setter
{
    public function set($propertyName, $value)
    {
        $this->{$propertyName} = $value;
    }
}
