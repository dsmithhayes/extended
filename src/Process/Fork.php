<?php

namespace Extended\Process;

use Extended\Process\Runnable;

class Fork
{
    /**
     * @var int
     *      The PID of the forked process
     */
    protected $pid;

    public function fork(Runnable $parent, Runnable $child)
    {
        $this->pid = pcntl_fork();

        if ($this->pid == -1) {
            $error = pcntl_strerror(pcntl_get_last_error());
            throw new ProcessException('Unable to fork the process: ' . $error);
        } elseif ($this->pid) {
            $parent->run();
            return pcntl_wait($this->pid);
        } else {
            $child->run();
            exit(0);
        }
    }
}
