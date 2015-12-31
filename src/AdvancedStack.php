<?php

namespace Extended;

use Extended\BasicStack;

/**
 * The AdvancedStack object contains the ability to manipulate and control the
 * internal stack pointer to the stack. This creates an interable object that
 * can be traversed.
 */
class AdvancedStack extends BasicStack implements \Iterator
{
    /**
     * Resets the entire stack.
     */
    public function reset()
    {
        $this->stack = [];
        $this->rewind();
    }

    /**
     * Sets the stack pointer. This is a fail-safe method.
     *
     * @param int $position The new position of the stack-pointer
     */
    public function setPointer($position)
    {
        $position = $this->pointerFloor($position);
        $position = $this->pointerCeiling($position);

        $this->pointer = $position;
    }

    /**
     * Increments the stack-pointer. This is a fail-safe method.
     */
    public function incrementPointer()
    {
        $this->pointer = $this->pointerCeiling(++$this->pointer);
    }

    /**
     * Decrements the stack-pointer. This is a fail-safe method.
     */
    public function decrementPointer()
    {
        $this->pointer = $this->pointerFloor(--$this->pointer);
    }

    /**
     * @return mixed The current item in the stack
     */
    public function current()
    {
        return $this->stack[$this->pointer];
    }

    /**
     * @return int The current position of the stack pointer
     */
    public function key()
    {
        return $this->pointer;
    }

    /**
     * Decrements the stack pointer to the next value in the list.
     */
    public function next()
    {
        --$this->pointer;
    }

    /**
     * Resets the stack pointer to the top of the stack.
     */
    public function rewind()
    {
        $this->pointer = (count($this->stack) - 1);
    }

    /**
     * Checks if the stack pointer points to a valid location in the stack
     *
     * @return bool True if the item exists in the stack
     */
    public function valid()
    {
        return ($this->pointer < 0) ? false : true;
    }
}
