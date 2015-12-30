<?php

namespace Extended;

use Extended\Structures\Stack;

/**
 * The BasicStack object represents a very slim implementation of a stack
 */
class BasicStack implements Stack
{
    /**
     * @var array The stack
     */
    protected $stack;

    /**
     * @var int The stack pointer
     */
    protected $pointer;

    /**
     * @param array $stack A stack to use within the object
     */
    public function __construct($stack = [])
    {
        $this->stack = array_values($stack);
        $this->pointer = (count($this->stack) - 1);
    }

    /**
     * @return mixed The value at the top of the stack
     */
    public function pop()
    {
        $item = $this->stack[$this->pointer];
        unset($this->stack[$this->pointer--]);      // decrements here
        return $item;
    }

    /**
     * @param mixed $value The item to add to the stack
     */
    public function push($value)
    {
        $this->stack[++$this->pointer] = $value;
    }

    /**
     * Assures the stack pointer can't be set to an invalid range
     *
     * @param  int $value A stack pointer to set
     * @return int        A valid stack pointer
     */
    protected function pointerCeiling($value)
    {
        $cieling = count($this->stack) - 1;
        return ($value > $cieling) ? $cieling : $value;
    }

    /**
     * Assures the stack pointer can't be set to an invalid range
     *
     * @param  int $value A stack pointer to set
     * @return int        A valid stack pointer
     */
    protected function pointerFloor($value)
    {
        return ($value < 0) ? 0 : $value;
    }
}
