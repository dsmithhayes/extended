<?php

namespace Extended\Traits;

use Extended\Traits\MapTrait;

trait DeepCopyTrait
{
    use MapTrait;

    /**
     * @param mixed $arr
     *      The value to copy
     * @return mixed
     *      The deep copied values
     */
    private function deepCopy($value)
    {
        if (is_array($value)) {
            $callback = function ($x) { return $x; };
            foreach ($this->mapGenerator($value, $callback) as $key => $val) {
                $value[$key] = $this->deepCopy($val);
            }

            return $value;
        }

        if (is_object($value)) {
            return clone $value;
        }

        return $value;
    }
}
