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

    public function testToFunc()
    {
        $parser = new Parser('(+ 2 5)');

        $this->assertEquals(2, $parser->toFunc('+')(1, 1));
        $this->assertEquals(10, $parser->toFunc('*')(2, 5));
    }
}
