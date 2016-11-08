<?php

namespace Extended\Stream;

/**
 * An InputBuffer will make sure that data can be added to its internal buffer
 * mechanism.
 */
interface InputBuffer
{
    /**
     * @param mixed $value
     *      What ever the value for the buffer should be
     */
    public function input($value);
}
