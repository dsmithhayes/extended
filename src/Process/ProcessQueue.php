<?php

namespace Extended\Process;

use Extended\Collections\Queue;
use Extended\Process\Runnable;

class ProcessQueue implements Queue
{
    private $processes;

    public function __construct(array $processes = [])
    {
        $this->processes = $processes;
    }

    public function enqueue(Runnable $process)
    {
        $this->processes[] = $process;
    }

    public function dequeue()
    {
        return array_shift($this->processes);
    }

    public function runNext()
    {
        $this->dequeue()->run();
    }

    public function runAll()
    {
        foreach ($this->processes as $process) {
            $process->run();
        }
    }
}
