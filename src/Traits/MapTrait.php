<?php

namespace Extended\Traits;

use Generator;

trait MapTrait
{
    /**
     * @param array $arr
     * @param callable $callback
     * @return array
     */
    public function map(array $arr, callable $callback): array
    {
        foreach ($arr as $key => $value) {
            $arr[$key] = $callback($value);
        }

        return $arr;
    }

    /**
     * @param array $arr
     * @param callable $callback
     * @return array
     */
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

    /**
     * @param array $arr
     * @param callable $callback
     * @return Generator
     */
    public function mapGenerator(array $arr, callable $callback): Generator
    {
        foreach ($arr as $val) {
            yield $callback($val);
        }
    }
}
