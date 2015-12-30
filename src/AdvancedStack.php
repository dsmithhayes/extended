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
     * Resets the entire stack, and stack pointer.
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
}
