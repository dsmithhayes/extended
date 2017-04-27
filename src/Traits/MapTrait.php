<?php

/**
 * @author Dave Smith-Hayes <me@davesmithhayes.com>
 */

namespace Extended\Traits;

/**
 * Trait MapTrait
 * @package Extended\Traits
 */
trait MapTrait
{
    public function map(array $arr, callable $callback): array
    {
        foreach ($arr as $key => $value) {
            $arr[$key] = $callback($value);
        }

        return $arr;
    }

    public function mapDeep(array $arr, callable $callback): array
    {
        foreach ($arr as $key => $value) {
            if (is_array($value)) {
                $arr[$key] = $this->mapDeep($value, $callback);
            } else {
                $arr[$key] = $callback($value);
            }
        }

        return $arr;
    }

    public function mapGenerator(array $arr, callable $callback)
    {
        foreach ($arr as $val) {
            yield $callback($val);
        }
    }

}
