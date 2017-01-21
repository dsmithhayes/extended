<?php

namespace Extended\Stream;

/**
 * An OutputBuffer has the ability to return all of the buffer data.
 */
interface OutputBuffer
{
    /**
     * Returns what ever is stored in the buffer.
     *
     * @return mixed
     */
    public function output();
}
