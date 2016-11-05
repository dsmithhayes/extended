<?php

namespace Extended\Process;

use Extended\Collections\Queue;
use Extended\Process\Runnable;
use Exteneded\Exception\ProcessException;

class ProcessQueue implements Queue
{
    private $processes;

    public function __construct(array $processes = [])
    {
        $this->enqueueMany($processes);
    }

    public function enqueue($process)
    {
        if ($process instanceof Runnable) {
            $this->processes[] = $process;
            return $this;
        }

        throw new ProcessException('Not a process.');
    }

    public function enqueueMany(array $processes)
    {
        $f = function () use ($processes) {
            foreach ($processes as $p) {
                if ($p instanceof Runnable) {
                    yield $p;
                }
            }
        };

        foreach ($f() as $p) {
            $this->enqueue($p);
        }

        return $this;
    }

    public function dequeue()
    {
        return array_shift($this->processes);
    }

    public function dequeueAll()
    {
        foreach ($this->processes as $p) {
            yield $p;
        }
    }

    public function runNext()
    {
        $this->dequeue()->run();
    }

    public function runAll()
    {
        foreach ($this->processes as $process) {
            yield $process->run();
        }
    }
}
