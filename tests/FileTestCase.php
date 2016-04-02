<?php

use Extended\File\File;

class FileTestCase extends PHPUnit_Framework_TestCase
{
    protected static $path;

    public function setupTestFile()
    {
        $this->path = dirname(__FILE__) . '/assets/test_file.txt';
    }

    public function testOpenFile()
    {
        self::setupTestFile();

        $file = new File($this->path);
    }
}
