<?php

use PHPUnit_Framework_TestCase as PHPUnitTestCase;

use Extended\Lisp\{CallStack, Category, Interpreter, Parser};

class LispTestCase extends PHPUnitTestCase
{
    public function testParser()
    {
        $parser = new Parser('(+ 3 4)');
        print_r($parser->run());
        exit;
    }
}
