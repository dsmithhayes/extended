<?php

namespace Extended\File;

/**
 * the Trait's methods are kind of expensive when used successively. Anyways, it
 * does arbitrary file path parsing for file name and the path sans filename
 */
trait ParsingTrait
{
    /**
     * This method will get the last file name or directory name from a path
     * string. So if you give it `/home/file` it will return `file`
     *
     * @param string $path
     *      The full path to get the file name from
     */
    public function parseFileName($path)
    {
        return basename($path);
    }

    /**
     * Returns the file path without the file. `/home/file` return `/home/`
     *
     * @param string $path
     *      The full path with the file name
     * @return string
     *      The path without the last entry file
     */
    public function parseFilePath($path)
    {
        return dirname($path);
    }
}
