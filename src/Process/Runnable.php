<?php

namespace Extended\Process;

/**
 * When a class implemented Runnable, it is able to be processed anywhere in
 * the application. Ideally the implemented `run()` would be a stateless
 * method that does not affect core functionality of the application.
 */
interface Runnable
{
    public function run();
}
