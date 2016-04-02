<?php

namespace Extended\File;

use Extended\Exception\FileException;
use Extended\File\Buffer;
use Extended\File\ParsingTrait;

/**
 * Some times you want a more OOP way to deal with files in PHP. That's what
 * this is.
 */

abstract class File extends Buffer
{
    /**
     * `parseFileName()`
     * `parseFullPath()`
     */
    use ParsingTrait;

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

        $this->fileName = $this->parseFileName($path);
        $this->fullpath = $this->parseFullPath($path);

        // read the contents of the file into the buffer
        $this->read($this->fileHandle);
    }

    /**
     * Closes the internal file resource.
     */
    public function __destruct()
    {
        fclose($this->fileHandle);
    }

    /**
     * Opens a file resource.
     *
     * @param $path string
     *      The path to the file in the file system
     * @param $mode string
     *      The mode to open the file with. Defaults to `w+`
     * @return \Extended\File\File
     */
    public function open($path, $mode = 'w+')
    {
        $this->fileHandle = fopen($path, $mode);

        if (!$this->fileHandle) {
            throw new FileException('Unable to open file: ' . $path);
        }

        return $this;
    }

    /**
     * @return \Extended\File\File
     */
    public function save()
    {
        if (!$this->fileName) {
            throw new FileException('Unable to save a file without a name.');
        }

        if (!fwrite($this->fileHandle, $this->fileSize())) {
            throw new FileException('Error writign the file to the filesystem');
        }

        return $this;
    }

    /**
     * Reads a file resource's contents into the buffer.
     *
     * @param resource|string $value
     *      Resource to read from, or string to set as the buffer
     * @param int|null $size
     *      How far into the file to read. If null, the hole file
     * @return \Extended\File\File
     */
    public function read($value, $size = null)
    {
        if (is_resource($value)) {
            if (!$size) {
                $size = $this->fileSize();
            }

            $this->buffer = fread($this->handle, $size);

            if (!$this->buffer) {
                throw new FileException('Unable to read the file resource');
            }
        } elseif (is_string($value)) {
            $this->buffer = $value;
        }

        return $this;
    }

    /**
     * @return int
     *      The file size of the current file handle
     */
    public function fileSize()
    {
        return filesize($this->fileHandle);
    }
}
