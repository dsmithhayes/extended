<?php

namespace Extended\File;

abstract class Buffer
{
    /**
     * @var mixed
     *      The actual buffer variable to deal with buffer operations
     */
    protected $buffer;

    /**
     * @param mixed
     *      The value to set as the buffer
     */
    public function __construct($value = null)
    {
        $this->buffer = $value;
    }

    /**
     * @return mixed
     *      Output whatever is in the buffer
     */
    public function writeBuffer()
    {
        return $this->buffer;
    }

    /**
     * @param mixed $value
     *      The value to read into the buffer
     * @return \Extended\File\Buffer
     */
    public function readBuffer($value)
    {
        $this->buffer = $value;
        return $this;
    }

    /**
     * Clears the entire buffer.
     *
     * @return \Extended\File\Buffer
     */
    public function clearBuffer()
    {
        $this->buffer = '';
        return $this;
    }
}
