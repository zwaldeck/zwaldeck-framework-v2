<?php

namespace Zwaldeck\Core\Exceptions;

/**
 * Class NoSuchServiceException
 * @package Zwaldeck\Core\Exceptions
 */
class NoSuchServiceException extends \Exception {


    /**
     * @param string $serviceName
     */
    public function __construct($serviceName)
    {
        parent::__construct("There is no service with the name '{$serviceName}'", 700);
    }
}