<?php

namespace Extended\File;

/**
 * Some times you want a more OOP way to deal with files in PHP. That's what
 * this is.
 */

class File
{
    /**
     * @var resource $handle
     *      The open file resource for the current object
     */
    protected $handle;

    /**
     * @var string $fileName
     *      The name of the current file
     */
    protected $fileName;

    /**
     * @var string $fullPath
     *      The full path in the filesystem for the current file
     */
    protected $fullPath;

    /**
     * @param string|null $path
     *      The full or relative path of the file to open
     */
    public function __construct($path = null)
    {
    }

    public function open($path)
    {

    }

    public function save()
    {

    }
}
