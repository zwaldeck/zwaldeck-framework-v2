<?php

namespace Zwaldeck\Core\Exceptions;

/**
 * Class NoSuchServiceException
 * @package Zwaldeck\Core\Exceptions
 */
class NoSuchParameterException extends \Exception {


    /**
     * @param string $serviceName
     */
    public function __construct($serviceName)
    {
        parent::__construct("There is no parameter with the name '{$serviceName}'", 701);
    }
}