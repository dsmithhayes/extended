<?php

namespace Extended\Stream;

use Extended\Stream\{InputBuffer, OutputBuffer};

/**
 * The buffer is a very basic implementation of a string buffer stream.
 */
abstract class Buffer implements InputBuffer, OutputBuffer
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
    public function output()
    {
        return $this->buffer;
    }

    /**
     * @param mixed $value
     *      The value to read into the buffer
     * @return \Extended\File\Buffer
     */
    public function input($value)
    {
        $this->buffer = $value;
        return $this;
    }

    /**
     * Clears the entire buffer.
     *
     * @return \Extended\File\Buffer
     */
    public function clear()
    {
        $this->buffer = null;
        return $this;
    }
}
