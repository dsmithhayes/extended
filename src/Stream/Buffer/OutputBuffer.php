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
     * Overrides the `input()` method from the parent class
     */
    public function input($value)
    {
        echo (string) $value;
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

    /**
     * Inherited method from the Buffer class
     */
    public function clear()
    {
        return $this->clean();
    }

    /**
     * Wraps the `ob_clean()` function
     */
    public function clean()
    {
        ob_clean();
        return $this;
    }

    /**
     * Returns the current buffer and clear it.
     *
     * @return string
     *      The buffer
     */
    public function getClean()
    {
        return ob_get_clean();
    }

    /**
     * Wraps the `ob_end_clean()` function
     */
    public function endClean()
    {
        ob_end_clean();
        return $this;
    }


    /**
     * Wraps the `ob_flush()` function
     */
    public function flush()
    {
        ob_flush();
        return $this;
    }

    /**
     * Returns the outpu buffer and closes it.
     *
     * @return string
     *      The current data in the buffer
     */
    public function getFlush(): string
    {
        return ob_get_flush();
    }

    /**
     * Wraps the `ob_end_flush()` function
     */
    public function endFlush()
    {
        ob_end_flush();
        return $this;
    }

    /**
     * @return int
     *      The length of the buffer in bytes
     */
    public function getLength(): int
    {
        return ob_get_length();
    }

    /**
     * @return int
     *      The level of the buffer
     */
    public function getLevel(): int
    {
        return ob_get_level();
    }

    /**
     * @param bool $fullStatus
     *      Whether or not to provide all of the information
     * @return array
     *      Array of information about the output buffer
     */
    public function getStatus(bool $fullStatus = false): array
    {
        return ob_get_status($fullStatus);
    }
}
