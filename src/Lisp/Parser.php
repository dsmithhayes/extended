<?php

namespace Extended\Lisp;

use Extended\Exception\LispException;

/**
 * When the Parser is run, it returns a nested array of tokenized data.
 *
 * '(+ 5 (- 9 3))' would parse into:
 */
class Parser
{
    /**
     * @var string
     *      The raw lisp stream as a buffer.
     */
    protected $stream;

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
     *      The stream of Lisp, either the stream that belongs to the object
     *      or one passed into it.
     * @return array
     *      An array of each token
     */
    public function tokenize($stream = null): array
    {
        $stream = ($stream) ?? $this->stream;

        $stream = preg_replace('/\(/', ' ( ', $stream);
        $stream = preg_replace('/\)/', ' ) ', $stream);

        return array_filter(preg_split('/\s/', trim($stream)));
    }

    /**
     * @param array|null $input
     *      The parsed input steam to organize
     * @param array $list
     *      Used for recursion, the list of all tokens categorized
     * @return array
     */
    public function parenthesize($input = null, $list = []): array
    {
        $input = ($input) ?? $this->tokenize($this->stream);
        $token = array_shift($input);

        if (is_null($token)) {
            return array_pop($list);
        } elseif ($token === '(') {
            $list[] = $this->parenthesize($input);
            return $this->parenthesize($input, $list);
        } elseif ($token === ')') {
            return $list;
        }

        $list = array_merge($list, $this->categorize($token));
        return $this->parenthesize($input, $list);
    }

    /**
     * @param mixed $input
     *      The token
     * @return array
     *      A key-value pair that defines if the value is an identifier or a
     *      literal token.
     */
    public function categorize($input): array
    {
        if (is_numeric($input)) {
            return [
                'type' => 'literal',
                'value' => $input
            ];
        } elseif ($input[0] === '"' && $input[strlen($input) - 1] === '"') {
            return [
                'type' => 'literal',
                'value' => substr($input, 1, -1)
            ];
        } else {
            return [
                'type' => 'identifier',
                'value' => $input
            ];
        }
    }
}
