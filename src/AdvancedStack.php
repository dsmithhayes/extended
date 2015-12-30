<?php

namespace Extended;

use Extended\BasicStack;
use Extended\Exception\StackException;

/**
 * The AdvancedStack object contains the ability to manipulate and control the
 * internal stack-pointer to the stack. This creates an interable object that
 * can be traversed.
 */
class AdvancedStack extends BasicStack implements \Iterator
{
    /**
     * Resets the entire stack.
     */
    public function resetStack()
    {
        $this->stack = [];
        $this->pointer = 0;
    }

    /**
     * Sets the internal stack-pointer back to 0.
     *
     * @return bool True if the pointer resets to 0
     */
    public function resetPointer()
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
     * Sets the stack pointer. This is a fail-safe method.
     *
     * @param  int  $position The new position of the stack-pointer
     * @return bool           True if the stack pointer is set to a valid number
     */
    public function setPointer($position)
    {
        if ($position < 0) {
            $positon = 0;
        }

        if ($position > (count($this->stack) - 1)) {
            $position = (count($this->stack) - 1);
        }

        $this->pointer = $position;
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

    protected function pointerCeiling($value)
    {
        $cieling = count($this->stack) - 1;

        return ($value > $cieling) ? $cieling : $value;
    }

    protected function pointerFloor($value)
    {
        return ($value < 0) ? 0 : $value;
    }
}
