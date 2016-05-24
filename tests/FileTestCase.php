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

        if (file_exists(static::$path)) {
            $file = new File(static::$path);
        }
    }
}
