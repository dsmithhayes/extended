<?php declare(strict_types=1);

/**
 * @author      Dave Smith-Hayes
 * @license     BSD 3.0
 */

namespace Extended\File;

use Extended\Exception\FileException;
use Extended\File\File;

/**
 * Represents a temporary file in the file system.
 */
class Tmp extends File
{
    /**
     * @param string $buffer
     *      The buffer to write into the temporary file
     */
    public function __construct(string $buffer = '')
    {
        $this->handle = tmpfile();
        $this->path   = sys_get_temp_dir();

        $this->setBuffer($buffer);
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
    public function save(string $name, string $path = null)
    {
        $this->setName($name);

        if ($path) {
            $this->setPath($path);
        }

        parent::save();
        return $this;
    }
}
