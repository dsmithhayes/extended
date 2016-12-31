<?php

namespace Extended\Process;

use Extended\Process\Runnable;
use Extended\Stream\Buffer;

class Fork
{
    /**
     * @var int
     *      The PID of the forked process
     */
    protected $pid;

    /**
     * @var \Extended\Stream\Buffer
     *      Active buffer of all the children's STDOUT
     */
    protected static $buffer;

    /**
     * @param string $buffer
     *      Pre-existing STDOUT buffer
     */
    public function __construct($buffer = '')
    {
        self::$buffer = new class($buffer) extends Buffer {
            public function append($b)
            {
                $this->buffer .= $b;
                return $this;
            }
        };
    }

    /**
     * @param \Extended\Process\Runnable $child
     *      A runnable process to fork
     */
    public function fork(Runnable $child)
    {
        $this->pid = pcntl_fork();

        // If there is an error with the process
        if ($this->pid == -1) {
            $error = pcntl_strerror(pcntl_get_last_error());
            throw new ProcessException('Unable to fork the process: ' . $error);

        // if the PID is still in the child
        } elseif ($this->pid) {
            return pcntl_wait($this->pid);
        }

        // The child process
        self::$buffer->append($child->run());
    }

    /**
     * @return string
     *      The output of all the children processes.
     */
    public function getBuffer()
    {
        return self::$buffer->output();
    }

    /**
     * Clears all of the data in the current buffer.
     */
    public function clearBuffer()
    {
        self::$buffer->clear();
    }
}
