<?php

use PHPUnit_Framework_TestCase as PHPUnitTestCase;
use Extended\Lisp\Parser;

class LispTestCase extends PHPUnitTestCase
{
    public function testTokenizer()
    {
        $parser = new Parser('(+ 2 (- 5 3))');
        $tokens = $parser->tokenize();
        $this->assertEquals('(', $tokens[0]);
    }

    public function testFunctionCall()
    {
        $parser = new Parser('(+ 2 5)');

        $this->assertEquals(2, ($parser->f('+'))(1, 1));
        $this->assertEquals(10, ($parser->f('*'))(2, 5));
        $this->assertEquals(2, ($parser->f('<<'))(1, 1));
    }
}
