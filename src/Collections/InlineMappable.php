<?php

namespace Extended\Collections;

/**
 * Interface InlineMappable
 * @package Extended\Collections
 */
interface InlineMappable
{
    /**
     * @param callable $callback
     * @return array
     */
    public function inlineMap(callable $callback): array;
}