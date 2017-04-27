<?php

use PHPUnit_Framework_TestCase as PHPUnitTestCase;
use Extended\MappableArray;

class MappableArrayTestCase extends PHPUnitTestCase
{
    public function testMap()
    {
        $arr = new MappableArray([1, 2, 3, 4]);
        $this->assertEquals(1, $arr[0]);

        $res = $arr->map(function($v) {
            return $v * 2;
        });

        $this->assertEquals(2, $res[0]);

        return $arr;
    }

    /**
     * @depends testMap
     */
    public function testInlineMap($arr)
    {
        $arr->inlineMap(function ($v) {
            return $v * 2;
        });

        $this->assertEquals(2, $arr[0]);
    }
}