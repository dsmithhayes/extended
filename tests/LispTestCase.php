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

        print_r($parser->parenthesize());
    }
}
