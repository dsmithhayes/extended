<?php

/**
 * @author Dave Smith-Hayes <me@davesmithhayes.com>
 */

namespace Extended\Stream;

/**
 * An OutputBuffer has the ability to return all of the buffer data.
 *
 * Interface OutputBuffer
 * @package Extended\Stream
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
