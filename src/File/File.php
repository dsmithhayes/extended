<?php

namespace Extended\File;

use Extended\FileException;

/**
 * Some times you want a more OOP way to deal with files in PHP. That's what
 * this is.
 */

class File
{
    /**
     * @var resource $fileHandle
     *      The open file resource for the current object
     */
    protected $fileHandle;

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
     * @var 
     *      Buffer size in bytes
     */
    protected $buffer;

    /**
     * Setting the `$path` as a resource will completely ignore the `$mode`.
     *
     * @param string|resource $path
     *      The full or relative path of the file to open
     * @param string $mode
     *      Valid file mode to open the file resource with
     */
    public function __construct($path, $mode = 'w+')
    {
        if (is_resource($path)) {
            $this->fileHandle = $path;
        } else {
            $this->fileHandle = fopen($path, $mode);
        }

        if (!$this->fileHandle) {
            throw new FileException('Unable to open or create the file.');
        }
    }

    public function open($path, $mode = 'w+')
    {
        $this->fileHandle = fopen($path, $mode);
    }

    public function save()
    {
        if (!$this->fileName) {
            throw new FileException('Cannot save a file without a file name.');
        }


    }
}
