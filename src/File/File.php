<?php

/**
 * @author Dave Smith-Hayes
 */

namespace Extended\File;

use Extended\Exception\FileException;
use Extended\File\Buffer;
use Serializable;

/**
 * Some times you want a more OOP way to deal with files in PHP. That's what
 * this is. This object will actually open and maintain an open file resource
 * while it is instantiated.
 */

class File extends Buffer implements Serializable
{
    /**
     * @var resource
     *      The open file resource for the current object
     */
    protected $handle;

    /**
     * @var string
     *      The name of the current file
     */
    protected $name;

    /**
     * @var string
     *      The full path in the filesystem for the current file
     */
    protected $path;

    /**
     * @param string $path
     *      The path to the file
     * @param string $mode
     *      The mode to open the file with
     * @param string|null $buffer
     *      If set, the new buffer for the file, otherwise the contents of the
     *      are read into the buffer
     * @throws \Extended\Exception\FileException
     *      When the file cannot be opened or created
     * @throws \Extended\Exception\FileException
     *      When the file resource can't be read into the buffer
     */
    public function __construct($path, $mode = 'w+', $buffer = null)
    {
        $this->handle = fopen($path, $mode);
        $this->name = basename($path);
        $this->path = dirname($path);

        if (!$this->handle) {
            throw new FileException('Unable to open or create the file.');
        }

        if ($buffer) {
            $this->buffer = $buffer;
        } else {
            $this->buffer = fread($this->handle, $this->filesize());

            if (!$this->buffer) {
                throw new FileException('Unable to read file into buffer.');
            }
        }
    }

    /**
     * Closes the internal file resource.
     */
    public function __destruct()
    {
       fclose($this->handle);
    }

    /**
     * Opens a new file resource.
     *
     * @param $path string
     *      The path to the file in the file system
     * @param $mode string
     *      The mode to open the file with. Defaults to `w+`
     * @return \Extended\File\File
     * @throws \Extended\Exception\FileException
     *      When the file is unable to be opened
     */
    public function open($path, $mode = 'w+')
    {
        fclose($this->handle);
        $this->handle = fopen($path, $mode);

        $this->name = basename($name);
        $this->path = dirname($name);

        if (!$this->handle) {
            throw new FileException('Unable to open file: ' . $path);
        }

        return $this;
    }

    /**
     * Writes the file to the file system.
     *
     * @return \Extended\File\File
     */
    public function save()
    {
        if (!$this->name) {
            throw new FileException('Unable to save a file without a name.');
        }

        // the write happens here
        if (!fwrite($this->handle, $this->filesize())) {
            throw new FileException('Error writing the file to the filesystem');
        }

        return $this;
    }

    /**
     * Arbitrarily sets the buffer. It uses the `strval()` method.
     *
     * @param string $value
     *      The data to hold in the buffer
     * @return \Extended\File\File
     */
    public function read($value)
    {
        $this->buffer = strval($value);
        return $this;
    }

    /**
     * @return int
     *      The file size of the current file handle
     */
    public function filesize()
    {
        return filesize($this->path . $this->name);
    }

    /**
     * @param resource $handle
     *      A file handle to set for the object
     * @return \Extended\File\File
     */
    public function setHandle($handle)
    {
        if (!is_resource($handle)) {
            throw new FileException(
                'Trying to set a file resource with non resource.',
                FileException::INVALID_SET_TYPE
            );
        }

        fclose($this->handle);
        $this->handle = $handle;

        return $this;
    }

    /**
     * @return resource
     *      The active file handle
     */
    public function getHandle()
    {
        return $this->handle;
    }

    /**
     * @return string
     *      The current name of the file
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     *      The path of the file
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * The method called before the object is serialized.
     *
     * @param string
     *      The full path of the file
     */
    public function serialize()
    {
        fclose($this->handle);
        $path = $this->path . $this->name;
        return serialize(['path' => $path]);
    }

    public function unserialize($serialized)
    {

    }
}
