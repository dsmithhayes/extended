<?php declare(strict_types=1);

/**
 * @author      Dave Smith-Hayes
 * @license     BSD 3.0
 */

namespace Extended\Exception;

class FileException extends \Exception
{
    /**
     * @var int
     *      Error code for when there is a problem with the file resource
     */
    const FILE_HANDLE_ERROR = 0;

    /**
     * @var int
     *      Error code for when trying to set the file resource
     */
    const INVALID_SET_TYPE = 1;
}
