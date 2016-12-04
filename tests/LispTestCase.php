<?php

use PHPUnit_Framework_TestCase as PHPUnitTestCase;

use Extended\Lisp\{
    CallStack,
    Category,
    Interpreter,
    Parser,
    Operator,
    Operand
};

class LispTestCase extends PHPUnitTestCase
{
    public function testParser()
    {
        $lisp = '(+ 1 2)';
        $parser = new Parser();

        $tokens = $parser->tokenize($lisp);
        $this->assertNotEmpty($tokens);
        $this->assertEquals('(', $tokens[0]);

        $category = $parser->categorize('"hello"');
        $this->assertEquals('literal', $category['type']);
        $this->assertEquals('hello', $category['value']);

        $category = $parser->categorize('+');
        $this->assertEquals('identifier', $category['type']);
    }

    public function testOperator()
    {
        $operator = new Operator('+');
        $this->assertTrue($operator->isArithmetic());
        $this->assertFalse($operator->isFunction());

        $operator = new Operator('substr');
        $this->assertFalse($operator->isArithmetic());
        $this->assertTrue($operator->isFunction());
    }
}
