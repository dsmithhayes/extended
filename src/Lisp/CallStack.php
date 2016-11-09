<?php

namespace Extended\Lisp;

use Extended\Exception\LispException;
use Extended\AdvancedStack as Stack;

class CallStack extends Stack
{
    public function __construct($stack = [])
    {
        if (!empty($stack)) {
            foreach ($stack as $n) {
                if (!is_callable($n)) {
                    throw new LispException("Item not callable.");
                }
            }
        }

        parent::__construct($stack);
    }

    public function push($value)
    {
        if (!is_callable($value)) {
            throw new LispException("Item not callable.");
        }
    }
}
