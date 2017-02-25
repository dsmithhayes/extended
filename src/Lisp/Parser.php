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
     * @return array
     *      An array of each token
     */
    public function tokenize(): array
    {
        $stream = $this->stream;

        $stream = preg_replace('/\(/', ' ( ', $stream);
        $stream = preg_replace('/\)/', ' ) ', $stream);

        return array_filter(preg_split('/\s/', trim($stream)));
    }
}
