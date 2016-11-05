<?php

namespace Extended\Process;

use Extended\Process\Runnable;
use Extended\File\Buffer;

class Fork
{
    /**
     * @var int
     *      The PID of the forked process
     */
    protected $pid;

    protected static $buffer;

    public function __construct($buffer = '')
    {
        self::$buffer = new class($buffer) extends Buffer {
            public function appendBuffer($b)
            {
                $this->buffer .= $b;
                return $this;
            }
        };
    }

    public function fork(Runnable $child)
    {
        $this->pid = pcntl_fork();

        if ($this->pid == -1) {
            $error = pcntl_strerror(pcntl_get_last_error());
            throw new ProcessException('Unable to fork the process: ' . $error);
        } elseif ($this->pid) {
            return pcntl_wait($this->pid);
        }

        self::$buffer->appendBuffer($child->run());
    }

    public function getBuffer()
    {
        return self::$buffer->writeBuffer();
    }

    public function clearBuffer()
    {
        self::$buffer->clearBuffer();
    }
}
