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
    public function testLastMethod($list)
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
}
