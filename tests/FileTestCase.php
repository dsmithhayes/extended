<?php

use Extended\File\File;

class FileTestCase extends PHPUnit_Framework_TestCase
{
    protected static $path;

    public function setupTestFile()
    {
        static::$path = dirname(__FILE__) . '/assets/test_file.txt';
    }

    public function testOpenFile()
    {
        static::setupTestFile();
        $file = new File(static::$path);

        $expected = 'test';
        $file->readBuffer($expected);

        $fileOutput = trim($file->writeBuffer());

        $this->assertEquals($expected, $fileOutput);
        $this->assertInstanceOf('\Extended\File\File', $file->save());

        $file2 = new File(static::$path, 'r');
        $fileOuput = trim($file2->writeBuffer());
        $this->assertEquals($expected, $fileOutput);
    }
}
