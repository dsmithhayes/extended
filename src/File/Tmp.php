<?php

namespace Extended\File;

use Extended\Exception\FileException;

class Tmp extends File
{
    public function __construct()
    {
        $this->fileHandle = tmpfile();
        $this->filePath = sys_get_temp_dir();
    }

    /**
     * @param $fileName string
     *      The name of the file to save
     * @param $fullPath string
     *      The full path of where to save the file
     */
    public function save($fileName, $fullPath = null)
    {
        $this->fileName = $fileName;

        if ($fullPath) {
            $this->fullPath = $fullPath;
        }

        parent::save();
    }
}
