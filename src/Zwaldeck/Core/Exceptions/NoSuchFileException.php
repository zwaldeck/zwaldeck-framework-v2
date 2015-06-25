<?php

namespace Zwaldeck\Core\Exceptions;

/**
 * Class NoSuchServiceException
 * @package Zwaldeck\Core\Exceptions
 */
class NoSuchFileException extends \Exception {


    /**
     * @param string $file
     */
    public function __construct($file)
    {
        parent::__construct("There is no file found in path: {$file}", 702);
    }
}