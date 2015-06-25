<?php

namespace Zwaldeck\Core\Exceptions;

/**
 * Class ControllerClassNotFoundException
 * @package Zwaldeck\Core\Exceptions
 */
class NoSuchActionException extends \Exception {

    public function __construct($class, $action)
    {
        parent::__construct("The controller class '{$class}' does not have the action '{$action}'", 706);
    }
}