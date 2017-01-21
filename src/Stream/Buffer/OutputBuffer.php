<?php

namespace Extended\Stream\Buffer;

use Extended\Stream\Buffer;

/**
 * @author Dave Smith-Hayes <me@davesmithhayes.com>
 */

/**
 * This class will extend the buffer and wrap PHP's internal output buffer.
 */
class OutputBuffer extends Buffer
{
    /**
     * @var callable
     *      A function with the signature: string ( string $buffer[, int phase ] )
     */
    private $callback = null;

    /**
     * @var int
     *      The chunk size of the output buffer
     */
    private $chunkSize = 0;

    /**
     * @var int
     *      The flags for the output
     */
    private $flags = PHP_OUTPUT_HANDLER_STDFLAGS;

    /**
     * @var bool
     */
    private $implicitFlush = false;

    /**
     * @param callable $callback
     *      This is the callback function that can be used with the `start()`
     *      method when it calls `ob_start()`
     */
    public function setCallback(callable $callback)
    {
        $this->callback = $callback;
        return $this;
    }

    /**
     * @param bool $flag
     *      Whether ot not the class should use implicit flushing
     */
    public function setImplicitFlush(bool $flag = false)
    {
        $this->implicitFlush = $flag;
        ob_implicit_flush($flag);

        return $this;
    }

    /**
     * Wraps `ob_start()`
     */
    public function start($callback = null, $chunkSize = null, $flags = null)
    {
        $callback = ($callback) ?? $this->callback;
        $chunkSize = ($chunkSize) ?? $this->chunkSize;
        $flags = ($flags) ?? $this->flags;

        ob_start($callback, $chunkSize, $flags);

        return $this;
    }

    /**
     * @return string
     *      Returns all the data in the output buffer
     */
    public function output()
    {
        return ob_get_contents();
    }

    public function clean()
    {
        ob_clean();
        return $this;
    }

    public function flush()
    {
        ob_flush();
        return $this;
    }
}
