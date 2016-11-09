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
    public $stack;

    /**
     * @param string $stream
     *      A string of Lisp code. (+ 5 (- 9 3))
     */
    public function __construct(string $stream)
    {
        $this->stack = $this->parenthesize($this->tokenize($stream));
    }

    /**
     * @param string $stream
     *      The stream of Lisp
     * @return array
     *      An array of each token
     */
    private function tokenize(string $stream): array
    {
        $stream = preg_replace('/\(/', ' ( ', $stream);
        $stream = preg_replace('/\)/', ' ) ', $stream);

        return preg_split('/\s/', trim($stream));
    }

    /**
     * Creates a nested array of the call stack.
     *
     * @param array $input
     *      The tokenized stream
     * @param array|null $list
     *      The next list of the stream
     * @return array
     *      The nested categories.
     */
    private function parenthesize($input, $list = null)
    {
        if (is_null($list)) {
            return $this->parenthesize($input, []);
        } else {
            $token = array_shift($input);

            if (is_null($token)) {
                return array_pop($list);
            }

            switch ($token) {
                case '(':
                    array_push($list, $this->parenthesize($input, []));
                    return parenthesize($input, $list);
                    break;
                case ')':
                    return $list;
                default:
                    return $this->parenthesize(
                        $input, array_push($list, $this->categorize($token))
                    );
            }
        }
    }

    /**
     * @param mixed $token
     *      The token to apply to a category
     * @return array
     *      The parenthesized stream of functions
     */
    private function categorize($token)
    {
        $lit = function($is_string = false) use ($token) {
            if ($is_string) {
                $token = substr(substr($token, -1), 1);
            }

            return [
                'type' => 'literal',
                'value' => $token
            ];
        };

        if (is_numeric($token)) {
            return $lit();
        }

        if (substr($token, 1) === '"' || substr($token, -1) === '"') {
            return $lit(true);
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
        return $this->stack;
    }
}
