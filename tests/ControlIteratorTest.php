<?php

use Extended\LinkedList;

class ControlerIteratorTest extends PHPUnit_Framework_TestCase
{
    public function testFirstMethod()
    {
        $list = new LinkedList();

        $list->add(1);

        for ($list->rewind(); $list->valid(); $list->next()) {
            $this->assertTrue($list->first());
            break;
        }

        return $list;
    }

    /**
     * @depends testFirstMethod
     */
    public function testLastMethodTrue($list)
    {
        $list->add(2);

        for ($list->rewind(); $list->valid(); $list->next()) {
            if ($list->current() === 2) {
                $this->assertTrue($list->last());
                break;
            }
        }

        return $list;
    }

    /**
     * @depends testLastMethodTrue
     */
    public function testLastMethodFalse($list)
    {
        for ($list->rewind(); $list->valid(); $list->next()) {
            if ($list->current() == 1) {
                $this->assertFalse($list->last());
                break;
            }
        }

        return $list;
    }

    /**
     * @depends testLastMethodFalse
     */
    public function testForeachTrue($list)
    {
        foreach ($list as $l) {
            if ($list->first()) {
                $this->assertEquals(1, $list->current());
            }
        }

        return $list;
    }

    public function testArrayConstruction()
    {
        $first = 'first';
        $last  = 'last';

        $list = new LinkedList([$first, $last]);

        foreach ($list as $l) {
            if ($list->first()) {
                $this->assertEquals($first, $l);
                break;
            }
        }

        return $list;
    }
}
