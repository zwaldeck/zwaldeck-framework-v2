<?php

namespace Zwaldeck\Core\Exceptions;

/**
 * Class ControllerClassNotFoundException
 * @package Zwaldeck\Core\Exceptions
 */
class PluginAlreadyRegisteredException extends \Exception {

    public function __construct($name)
    {
        parent::__construct("There is already a plugin registered for the name '{$name}', make sure all the plugins have a unique name!", 707);
    }
}