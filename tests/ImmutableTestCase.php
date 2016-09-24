<?php

use PHPUnit_Framework_TestCase as PHPUnitTestCase;

use Extended\Immutable\Immutable;

/**
 * Immutability in PHP is actually rather difficult to achieve. This test case
 * will hopefully shed some light on how the language handles its data
 * internally. The language used in this test case will assume the idea that
 * integers, floating point values, booleans, strings and characters are
 * primitive types. Arrays, being the holy data structures that they are in PHP,
 * will act as an intermediate type, while objects big and small will be more
 * abstract types.
 */
class ImmutableTestCase extends PHPUnitTestCase
{
    /**
     * @expectedException \Extended\Exception\ImmutableException
     */
    public function testImmutability()
    {
        /**
         * Primitive integer inside an immutable object
         */
        $number = new Immutable(['first' => 10]);

        $number->first = 11;
    }

    public function testArrays()
    {
        /**
         * Shows that Arrays are always copied when they have primitive data
         */
        $arr = new Immutable([
            'data' => [
                'num' => 10
            ]
        ]);

        $d = $arr->data;
        $d['num'] = 11;

        $this->assertEquals(10, $arr->data['num']);
    }

    public function testDeepCopies()
    {
        /**
         * The next assertion will show how the Immutable class will handle
         * properties which are objects.
         */
        $obj = new Immutable([
            'o' => new class {
                public $prop = 10;
            }
        ]);

        $new = $obj->o;
        $new->prop = 11;

        $this->assertEquals(10, $obj->o->prop);
    }
}
