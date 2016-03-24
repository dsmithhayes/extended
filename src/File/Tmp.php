<?php

namespace Extended\File;

class Tmp extends File
{
    public function __construct()
    {
        $this->fileHandle = tmpfile();
        $this->filePath = sys_get_temp_dir();
    }

    public function save($fileName)
    {
        $this->fileName = $fileName;
        $this->save();
    }
}
