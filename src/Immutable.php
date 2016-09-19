<?php

namespace Extended;

use Extended\ImmutableInterface;

abstract class Immutable implements ImmutableInterface
{
    private $key;
    private $value;

    public function __construct($key, $value)
    {
        $this->key = $key;
        $this->value = $value;
    }

    public function get($key)
    {
        return $this->key;
    }

    public function __get($key)
    {
        return $this->key;
    }

    public function __set($key, $value)
    {
        return null;
    }
}
