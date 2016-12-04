<?php

namespace Extended\Lisp;

class Operator
{
    private $arithmeticTokens = [
        'add'      => '+',
        'subtract' => '-',
        'multiply' => '*',
        'divide'   => '/',
        'modulo'   => '%'
    ]

    private $token;

    public function __construct($token)
    {

        $this->token = $token;
    }

    /**
     * @param string $token
     *      The token for the operator
     * @return bool
     *      True if the token is an arithmetic operator
     */
    public function isArithmetic(string $token): bool
    {
        if (in_array($token, $this->arithmeticTokens) || array_key_exists($token, $this->arithmeticTokens)) {
            return true;
        }

        return false;
    }
}
