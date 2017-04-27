<?php

/**
 * @author Dave Smith-Hayes <me@davesmithhayes.com>
 */

namespace Extended\File;

use Extended\Exception\FileException;
use Extended\File\File;

/**
 * Represents a temporary file in the file system.
 *
 * Class Tmp
 * @package Extended\File
 */
class Tmp extends File
{
    /**
     * @param string|null $buffer
     *      The buffer to write into the temporary file
     */
    public function __construct($buffer = null)
    {
        $this->handle = tmpfile();
        $this->path = sys_get_temp_dir();

        if ($buffer) {
            $this->buffer = $buffer;
        }
    }

    /**
     * @param string $fileName
     *      The name of the file to save
     * @param string $fullPath
     *      The full path of where to save the file
     * @return \Extended\File\Tmp;
     * @throws \Extended\Exception\FileException
     *      If the file could not be saved
     */
    public function save($name, $path = null)
    {
        $this->name = $name;

        if ($path) {
            $this->path = $path;
        }

        parent::save();
        return $this;
    }
}
