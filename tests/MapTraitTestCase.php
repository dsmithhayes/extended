<?php

use Extended\Traits\MapTrait;
use PHPUnit_Framework_TestCase as PHPUnitTestCase;

/**
 * Tests the `map` function
 */
class MapTraitTestCase extends PHPUnitTestCase
{
    public function testMapFunction()
    {
        $arr = [ 'hello', 'dave' ];

        $callback = function ($x) {
            return strtoupper($x);
        };

        $mapper = new class {
            use MapTrait;
        };

        $arr = $mapper->map($arr, $callback);
        $this->assertEquals('HELLO', $arr[0]);
        $this->assertEquals('DAVE', $arr[1]);
    }

    public function testDeepMapFunction()
    {
        $arr = [ 1, 2, [3, 4] ];

        $callback = function ($x) {
            return $x + $x;
        };

        $mapper = new class {
            use MapTrait;
        };

        $arr = $mapper->mapDeep($arr, $callback);
        $this->assertEquals(2, $arr[0]);
        $this->assertEquals(6, $arr[2][0]);
    }

    public function testGenerator()
    {
        $str = 'word';

        $mapper = new class {
            use MapTrait;
        };

        $callback = function ($x) {
            return strtoupper($x);
        };

        foreach ($mapper->mapGenerator(str_split($str), $callback) as $value) {
            $matches = preg_match('/[WORD]/', $value);
            $this->assertTrue(($matches > 0));
        }
    }
}
