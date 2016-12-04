<?php

namespace Extended\Lisp;

use Extended\Process\Runnable;

/**
 * When the Parser is run, it returns a nested array of tokenized data.
 *
 * '(+ 5 (- 9 3))' would parse into:
 */
class Parser implements Runnable
{
    /**
     * @var The callstack.
     */
    public $stack;

    /**
     * @param string $stream
     *      A string of Lisp code. (+ 5 (- 9 3))
     */
    public function __construct()
    {

    }

    /**
     * @param string $stream
     *      The stream of Lisp
     * @return array
     *      An array of each token
     */
    public function tokenize(string $stream): array
    {
        $stream = preg_replace('/\(/', ' ( ', $stream);
        $stream = preg_replace('/\)/', ' ) ', $stream);

        return preg_split('/\s/', trim($stream));
    }

    /**
     * Creates a nested array of the call stack.
     */
    public function parenthesize(array $input, $list = [])
    {
        $token = array_shift($input);

        if (substr($token, 0, 1) === '(') {
            
        }
    }

    /**
     * @param mixed $token
     *      The token to apply to a category
     * @return array
     *      The parenthesized stream of functions
     */
    public function categorize($token)
    {
        $lit = function($token, $is_string = false) {
            if ($is_string) {
                $token = substr($token, 1, -1);
            }

            return [
                'type' => 'literal',
                'value' => $token
            ];
        };

        if (is_numeric($token)) {
            return $lit($token);
        }

        if (substr($token, 1) === '"' && substr($token, -1) === '"') {
            return $lit($token, true);
        }

        return [
            'type' => 'identifier',
            'value' => $token
        ];
    }

    /**
     * @return array
     *      The parsed call stack
     */
    public function getStack(): array
    {
        return $this->stack;
    }

    /**
     * Returns the parsed and categorized parsed data
     */
    public function run()
    {
        // iterate over the stack,

        // make the calls
    }
}
