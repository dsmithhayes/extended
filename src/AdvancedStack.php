<?php

namespace Extended;

use Extended\BasicStack;

class AdvancedStack extends BasicStack implements \Iterator
{
    /**
     * Resets the entire stack.
     *
     * @return void
     */
    public function reset()
    {
        $this->stack   = [];
        $this->pointer = 0;
    }

    /**
     * @return mixed
     *      The current item in the stack
     */
    public function current()
    {
        return $this->stack[$this->pointer];
    }

    /**
     * @return int
     *      The current position of the stack pointer
     */
    public function key()
    {
        return $this->pointer;
    }

    /**
     * Decrements the stack pointer to the next value in the list.
     *
     * @return void
     */
    public function next()
    {
        --$this->pointer;
    }

    /**
     * Resets the stack pointer to the top of the stack.
     *
     * @return void
     */
    public function rewind()
    {
        $this->pointer = (count($this->stack) - 1);
    }

    /**
     * Checks if the stack pointer points to a valid location in the stack
     *
     * @return bool
     *      True if the item exists in the stack
     */
    public function valid()
    {
        if ($this->pointer < 0) {
            $this->pointer = 0;
            return false;
        }

        return true;
    }

    /**
     * Assures the stack pointer can't be set to an invalid range
     *
     * @param  int $value
     *      A stack pointer to set
     * @return int
     *      A valid stack pointer
     */
    protected function pointerCeiling($value)
    {
        $cieling = count($this->stack) - 1;
        return ($value > $cieling) ? $cieling : $value;
    }

    /**
     * Assures the stack pointer can't be set to an invalid range
     *
     * @param  int $value
     *      A stack pointer to set
     * @return int
     *      A valid stack pointer
     */
    protected function pointerFloor($value)
    {
        return ($value < 0) ? 0 : $value;
    }
}
