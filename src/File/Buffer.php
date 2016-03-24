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
     * @return mixed
     *      Output whatever is in the buffer
     */
    public function write();

    /**
     * @param mixed $value
     *      The value to read into the buffer
     */
    public function read($value);
}
