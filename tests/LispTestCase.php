<?php

use PHPUnit_Framework_TestCase as PHPUnitTestCase;

use Extended\Lisp\{CallStack, Category, Interpreter, Parser};

class LispTestCase extends PHPUnitTestCase
{
    public function testParser()
    {
        $parser = new Parser();

        $tokens = $parser->tokenize('(+ 1 2)');
        $this->assertNotEmpty($tokens);
        $this->assertEquals('(', $tokens[0]);

        
    }
}
