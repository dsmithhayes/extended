<?php

use PHPUnit_Framework_TestCase as PHPUnitTestCase;

use Extended\Immutable\Immutable;

class ImmutableTestCase extends PHPUnitTestCase
{
    public function testImmutability()
    {
        $number = new Immutable([
            'first' => 10
        ]);

        $number->first = 11;
        $this->assertEquals(10, $number->first);
    }
}
