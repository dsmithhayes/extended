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
     * @var string
     *      The raw lisp stream as a buffer.
     */
    public $stream;

    /**
     * @param string $stream
     *      A string of Lisp code. (+ 5 (- 9 3))
     */
    public function __construct(string $stream)
    {
        $this->stream = $stream;
    }

    /**
     * @param string|null $stream
     *      The stream of Lisp
     * @return array
     *      An array of each token
     */
    public function tokenize($stream = null): array
    {
        $stream = ($stream) ?? $this->stream;

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

        if (!$token) {
            return array_shift($list);
        } elseif (substr($token, 0, 1) === '(') {
            $list = array_push($list, $this->parenthesize($input, []));
            return $this->parenthesize($input, $list);
        } elseif (substr($token, -1, 1) === ')') {
            return $list;
        } else {
            return $this->parenthesize($input, ($list[] = $this->categorize($token)));
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
            $token = ($is_string) ? substr($token, 1, -1) : $token;

            return [
                'type' => 'literal',
                'value' => $token
            ];
        };

        if (is_numeric($token)) {
            return $lit($token);
        }

        if (substr($token, 0, 1) === '"' && substr($token, -1, 1) === '"') {
            return $lit($token, true);
        }

        return [
            'type' => 'identifier',
            'value' => $token
        ];
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
