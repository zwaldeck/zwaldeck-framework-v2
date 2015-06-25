<?php

namespace Zwaldeck\Core\Exceptions;

/**
 * Class ControllerClassNotFoundException
 * @package Zwaldeck\Core\Exceptions
 */
class ControllerClassNotFoundException extends \Exception {

    public function __construct($class)
    {
        parent::__construct("Could not find controller for class: '{$class}'", 704);
    }
}