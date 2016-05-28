<?php declare(strict_types=1);

/**
 * @author      Dave Smith-Hayes
 * @license     BSD 3.0
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
     * @var string
     *      The mode to use `fopen()` with
     */
    protected $mode;

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
    public function __construct(string $path,
                                string $mode = 'w+',
                                string $buffer = null)
    {
        $this->handle = fopen($path, $mode);
        $this->name   = basename($path);
        $this->path   = dirname($path);
        $this->mode   = $mode;

        if (!$this->handle) {
            throw new FileException('Unable to open or create the file.');
        }

        if ($buffer) {
            $this->buffer = $buffer;
        } else {
            if ($this->filesize() > 0) {
                $this->buffer = fread($this->handle, $this->filesize());

                if (!$this->buffer) {
                    throw new FileException('Unable to read file into buffer.');
                }
            } else {
                $this->buffer = '';
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
     * Opens a new file resource, it does not clear the buffer.
     *
     * @param $path string
     *      The path to the file in the file system
     * @param $mode string
     *      The mode to open the file with. Defaults to `w+`
     * @return \Extended\File\File
     * @throws \Extended\Exception\FileException
     *      When the file is unable to be opened
     */
    public function open(string $path, string $mode = 'w+')
    {
        if ($this->handle) {
            fclose($this->handle);
        }

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
        if (!fwrite($this->handle, $this->buffer)) {
            throw new FileException(
                'Error writing the file to the filesystem.'
            );
        }

        return $this;
    }

    /**
     * Reads the buffer, or the handle contents out.
     *
     * @param bool $fromBuffer
     *      If true, read from the buffer instead of the file handle
     * @return \Extended\File\File
     */
    public function read(bool $fromBuffer = true)
    {
        if ($fromBuffer) {
            return $this->writeBuffer();
        }

        return fread($this->handle, $this->filesize());
    }

    /**
     * @return int
     *      The file size of the current file handle
     */
    public function filesize(): int
    {
        return filesize($this->path . '/' . $this->name);
    }

    /**
     * @param resource $handle
     *      A file handle to set for the object
     * @return \Extended\File\File
     */
    public function setHandle(resource $handle)
    {
        if (!is_resource($handle)) {
            throw new FileException(
                'Trying to set a file resource with non-resource.',
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
     * @param string $name
     *      The name to set for the file
     * @return Extended\File\File
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     *      The current name of the file
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $path
     *      The path to set for the file
     * @return \Extended\File\File
     */
    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @return string
     *      The path of the file
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param string $mode
     *      The mode to set for the file
     * @return \Extended\File\File
     */
    public function setMode($mode)
    {
        $this->mode = $mode;
        return $this;
    }

    /**
     * @return string
     *      The mode of the file opened
     */
    public function getMode(): string
    {
        return $this->mode;
    }

    /**
     * The method called before the object is serialized. It saves the full path
     * along with the file mode to re-open the file when the object is
     * unserialized.
     *
     * @return string
     *      Serialized representation of the path and mode for the current file
     *      opened within the object, along with any buffer that is set
     */
    public function serialize(): string
    {
        fclose($this->handle);
        $path = $this->path . $this->name;
        return serialize([
            'path' => $path,
            'mode' => $this->mode,
            'buffer' => $this->getBuffer()
        ]);
    }

    /**
     * @param string $serialized
     *      The serialized object
     * @throws \Extended\Exception\FileException
     *      When the file information that has been serialized is invalid
     */
    public function unserialize($serialized)
    {
        try {
            $seriazlied = unserialize($serialized);
            $this->setBuffer($serialized['buffer']);
            $this->open($serialized['path'], $serialized['mode']);
        } catch (FileException $fe) {
            $message  = 'Unable to unserialize and open the file: ';
            $message .= $serialized['path'];

            throw new FileException($message);
        }
    }
}
