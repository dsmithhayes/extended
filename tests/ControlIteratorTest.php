<?php

use Extended\LinkedList;

class ControlerIteratorTest extends PHPUnit_Framework_TestCase
{
    protected $first = 'first';
    protected $last  = 'last';
    protected $exampleSet = ['first', 'second'];

    public function testFirstMethod()
    {
        $list = new LinkedList();

        $list->add($this->first);

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
        $list->add($this->last);

        for ($list->rewind(); $list->valid(); $list->next()) {
            if ($list->current() === $this->last) {
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
            $this->assertFalse($list->last());
            break;
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
                $this->assertEquals($this->first, $list->current());
            }
        }

        return $list;
    }

    /**
     * @depends testForeachTrue
     */
    public function testForeachFalse($list)
    {
        foreach ($list as $l) {
            $this->assertFalse($list->last());
            break;
        }

        return $list;
    }

    /**
     * @depends testForeachFalse
     */
    public function testGetFirst($list)
    {
        $this->assertEquals($this->first, $list->getFirst());
        return $list;
    }

    /**
     * @depends testGetFirst
     */
    public function testGetLast($list)
    {
        $this->assertEquals($this->last, $list->getLast());
        return $list;
    }

    public function testArrayConstruction()
    {
        $list = new LinkedList($this->exampleSet);

        foreach ($list as $l) {
            if ($list->first()) {
                $this->assertEquals($this->first, $l);
                break;
            }
        }

        return $list;
    }
}
