<?php

/**
 * @author Dave Smith-Hayes <me@davesmithhayes.com>
 */

namespace Extended;

use Extended\Collections\Stack;
use Extended\Exception\StackException;

/**
 * The BasicStack object represents a very slim implementation of a stack.
 *
 * Class BasicStack
 * @package Extended
 */
class BasicStack implements Stack
{
    /**
     * @var array
     *      The stack
     */
    protected $stack;

    /**
     * @var int
     *      The stack pointer
     */
    protected $pointer;

    /**
     * @param array $stack
     *      A stack to use within the object
     */
    public function __construct($stack = [])
    {
        $this->stack   = array_values($stack);
        $this->pointer = (count($this->stack) - 1);

        $this->pointer = ($this->pointer < 0) ? 0 : $this->pointer;
    }

    /**
     * @throws StackException
     *      When you attempt to pop from an empty stack
     * @return mixed
     *      The value at the top of the stack
     */
    public function pop()
    {
        if (empty($this->stack)) {
            throw new StackException('The stack is empty.',  StackException::STACK_EMPTY);
        }

        $item = $this->stack[$this->pointer];

        unset($this->stack[$this->pointer]);
        $this->pointer--;
        
        return $item;
    }

    /**
     * @param mixed $value
     *      The item to add to the stack
     */
    public function push($value)
    {
        $this->stack[++$this->pointer] = $value;
    }
}
