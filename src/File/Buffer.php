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
    public function write()
    {
        return $this->buffer;
    }

    /**
     * @param mixed $value
     *      The value to read into the buffer
     */
    public function read($value)
    {
        $this->buffer = $value;
    }
}
