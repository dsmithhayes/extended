<?php

namespace Extended\Structures;

/**
 * Stacks are data structures that have a first-in / last-out philosophy. You
 * push data onto the stack, and you pop it off the top. This interface helps
 * define these two crucial methods.
 */
interface Stack
{
    /**
     * Popping should remove the item from the stack entirely, but it really
     * doesn't have to if you don't want it to. Ideally its just going to
     * return whatever the stack pointer is pointing out.
     */
    public function pop();

    /**
     * Pushing data into the stack is very simple. Ideally it will always be
     * pushed onto the top of the stack, but really it just works by inserting
     * data one block ahead of the stack pointer.
     */
    public function push($value);
}
