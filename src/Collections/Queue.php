<?php

namespace Extended\Collections;

interface Queue
{
    public function enqueue();

    public function dequeue();
}
