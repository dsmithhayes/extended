<?php

/**
 * @author Dave Smith-Hayes <me@davesmithhayes.com>
 */

namespace Extended\Traits;

use Extended\Traits\MapTrait;

/**
 * Trait DeepCopyTrait
 * @package Extended\Traits
 */
trait DeepCopyTrait
{
    use MapTrait;

    /**
     * @param mixed $value
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
