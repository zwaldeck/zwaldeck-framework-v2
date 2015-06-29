<?php

namespace Zwaldeck\Core\Exceptions;

/**
 * Class NoSuchServiceException
 * @package Zwaldeck\Core\Exceptions
 */
class NoSuchViewException extends \Exception {


    /**
     * @param string $view
     * @param int $file
     */
    public function __construct($view, $file)
    {
        parent::__construct("There was no view found for '{$view}'. Try to add this file: {$file}", 709);
    }
}