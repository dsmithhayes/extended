<?php

namespace Extended\Lisp;

class Operand
{
    private $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function __toString()
    {
        return $this->token;
    }

    public function isLiteral($token = null): bool
    {
        return false;
    }
}
