<?php

namespace Extended\Lisp;

use Extended\Stream\Buffer;
use Extended\Process\Runnable;
use Extended\Lisp\CallStack;
use Extended\Lisp\Parser;

class Interpreter extends Buffer implements Runnable
{
    /**
     * @var \Extended\Lisp\CallStack
     */
    private $callStack;

    /**
     * @var \Extended\Lisp\Parser
     */
    private $parser;

    public function __construct($buffer = null)
    {
        if (is_null($buffer)) {
            $buffer = '';
        }

        if (!is_string($buffer)) {
            throw new LispException('Constructing from non string stream.');
        }

        $this->parser = new Parser($buffer);
        $this->callStack = new CallStack($this->parser->run());
        parent::__construct($buffer);
    }

    public function run()
    {

    }
}
