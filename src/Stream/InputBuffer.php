<?php

/**
 * @author Dave Smith-Hayes <me@davesmithhayes.com>
 */

namespace Extended\Stream;

/**
 * An InputBuffer will make sure that data can be added to its internal buffer
 * mechanism.
 *
 * Interface InputBuffer
 * @package Extended\Stream
 */
interface InputBuffer
{
    /**
     * @param mixed $value
     *      What ever the value for the buffer should be
     */
    public function input($value);
}
