<?php

namespace Zwaldeck\Core\Exceptions;

/**
 * Class NoSuchServiceException
 * @package Zwaldeck\Core\Exceptions
 */
class NoSuchVariableInViewException extends \Exception {


    /**
     * @param string $var
     */
    public function __construct($var)
    {
        parent::__construct("There is no variable found for '{$var}'. Try to send it through the render method!", 710);
    }
}