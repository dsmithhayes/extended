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
    protected $pointer;

    /**
     * @param array $stack A list of items to use as a stack.
     */
    public function __construct($stack = [])
    {
        $this->stack = array_values($stack);
        $this->pointer = (count($stack) - 1);
    }

    /**
     * This will not only return the item at the top of the stack, but also
     * unset the variable.
     *
     * @return mixed The top item of the stack
     */
    public function pop()
    {
        $temp = $this->stack[$this->pointer];
        unset($this->stack[$this->pointer--]);      // decrements here
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
     *
     * @return bool True if the pointer resets to 0
     */
    public function reset()
    {
        $this->pointer = 0;
        return true;
    }

    /**
     * @return int The current position of the stack-pointer.
     */
    public function getPointer()
    {
        return $this->pointer;
    }

    /**
     * @param int $position The new position of the stack-pointer.
     * @return bool True if the stack pointer is set to a valid number
     */
    public function setPointer($position)
    {
        if ($position >= count($this->stack)) {

        }

        $this->stackPointer = $position;
        return true;
    }

    /**
     * Increments the stack-pointer. This is a fail-safe method.
     */
    public function incrementPointer()
    {
        $this->pointer++;

        if ($this->pointer >= count($this->stack)) {
            $this->pointer = (count($this->stack) - 1);
        }
    }

    /**
     * Decrements the stack-pointer. This is a fail-safe method.
     */
    public function decrementPointer()
    {
        $this->pointer--;

        if ($this->pointer < 0) {
            $this->pointer = 0;
        }
    }
}
