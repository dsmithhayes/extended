<?php

namespace Extended\Lisp;

class Operator
{
    /**
     * @var array
     *      List of all the arithmetic tokens, along with name of the opeartor
     */
    private $arithmeticTokens = [
        'add'      => '+',
        'subtract' => '-',
        'multiply' => '*',
        'divide'   => '/',
        'modulo'   => '%'
    ];

    /**
     * @var string
     *      The internal token buffer
     */
    private $token;

    /**
     * @param string $token
     *      The operator token
     */
    public function __construct(string $token)
    {
        $this->token = $token;
    }

    /**
     * @return string
     *      The string representation of the token
     */
    public function __toString()
    {
        return $this->token;
    }

    /**
     * @param string $token
     *      The token for the operator
     * @return bool
     *      True if the token is an arithmetic operator
     */
    public function isArithmetic($token = null): bool
    {
        $token = $token ?? $this->token;

        if (in_array($token, $this->arithmeticTokens) ||
            array_key_exists($token, $this->arithmeticTokens)
        ) {
            return true;
        }

        return false;
    }

    /**
     * @param string|null $token
     *      The token to check, if null, the internal buffered token
     * @return bool
     *      True if the token is a PHP function
     */
    public function isFunction($token = null): bool
    {
        $token = $token ?? $this->token;
        return function_exists($token);
    }
}
