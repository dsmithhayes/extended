<?php

namespace Extended;

/**
 * If you have studied computer science in any capacity, you should know what a
 * stack is and how it works. This is a PHP implementation of a stack.
 */
class Stack
{
    /**
     * @var array The internal stack of the object
     */
    protected $stack;

    /**
     * @var int The stack-pointer
     */
    protected $stackPointer;

    /**
     * @param array $stack A list of items to use as a stack.
     */
    public function __construct($stack = [])
    {
        $this->stack = array_values($stack);
        $this->stackPointer = (count($stack) - 1);
    }

    /**
     * This will not only return the item at the top of the stack, but also
     * unset the variable.
     *
     * @return mixed The top item of the stack
     */
    public function pop()
    {
        $temp = $this->stack[$this->stackPointer];
        unset($this->stack[$this->stackPointer--]);
        $this->stack = array_values($this->stack);
        return $temp;
    }

    /**
     * @param mixed $whatever The item to push to the top of the stack
     */
    public function push($whatever)
    {
        $this->stack[] = $whatever;
    }

    /**
     * Sets the internal stack-pointer back to 0.
     */
    public function reset()
    {
        $this->stackPointer = 0;
    }

    /**
     * @return int The current position of the stack-pointer.
     */
    public function getStackPointer()
    {
        return $this->stackPointer;
    }

    /**
     * @param int $position The new position of the stack-pointer.
     */
    public function setStackPointer($position)
    {

    }
}
