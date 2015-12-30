<?php

namespace Extended;

use Extended\Structures\Stack;

class BasicStack implements Stack
{
    protected $stack;
    protected $pointer;

    public function __construct($stack = [], $setPointer = false)
    {
        $this->stack = array_values($stack);
        $this->pointer = ($setPointer) ? (count($this->stack) - 1) : 0;
    }

    public function pop()
    {

    }

    public function push($value)
    {

    }
}
