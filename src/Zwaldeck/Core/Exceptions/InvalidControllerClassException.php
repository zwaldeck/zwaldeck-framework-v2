<?php

namespace Zwaldeck\Core\Exceptions;

/**
 * Class ControllerClassNotFoundException
 * @package Zwaldeck\Core\Exceptions
 */
class InvalidControllerClassException extends \Exception {

    public function __construct($class)
    {
        parent::__construct("The controller class '{$class}' must extend Zwaldeck\\Core\\Controller\\Controller", 705);
    }
}