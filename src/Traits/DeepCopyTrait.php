<?php

namespace Extended\Traits;

trait DeepCopyTrait
{
    /**
     * @param mixed $arr
     *      The value to copy
     * @return array
     *      The deep copied values
     */
    private function deepCopy($value)
    {
        if (is_array($value)) {
            $tmp = [];

            foreach ($value as $key => $val) {
                $tmp[$key] = $this->deepCopy($val);
            }

            return $tmp;
        }

        if (is_object($value)) {
            return clone $value;
        }

        return $value;
    }
}
