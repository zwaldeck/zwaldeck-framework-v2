<?php

namespace Zwaldeck\Core\Exceptions;

/**
 * Class NoSuchServiceException
 * @package Zwaldeck\Core\Exceptions
 */
class NoSuchPluginException extends \Exception {


    /**
     * @param string $plugin
     */
    public function __construct($plugin)
    {
        parent::__construct("There is no plugin with the name '{$plugin}'", 708);
    }
}