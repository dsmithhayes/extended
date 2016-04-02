<?php

namespace Extended\File;

use Extended\Exception\FileException;
use Extended\File\File;

/**
 * Represents a temporary file in the file system.
 */
class Tmp extends File
{
    public function __construct($buffer = null)
    {
        $this->fileHandle = tmpfile();
        $this->fullPath = sys_get_temp_dir();

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
    public function save($fileName, $fullPath = null)
    {
        $this->fileName = $fileName;

        if ($fullPath) {
            $this->fullPath = $fullPath;
        }

        parent::save();
        return $this;
    }
}
