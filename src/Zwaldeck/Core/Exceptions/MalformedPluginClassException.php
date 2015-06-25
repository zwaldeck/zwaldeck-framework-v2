<?php

namespace Zwaldeck\Core\Exceptions;

/**
 * Class NoSuchServiceException
 * @package Zwaldeck\Core\Exceptions
 */
class MalformedPluginClassException extends \Exception {


    /**
     * @param string $file
     */
    public function __construct($file)
    {
        parent::__construct("If the file in the root directory from your plugin ends with 'Plugin.php' it must extend the class 'Zwaldeck\\Core\\Plugin\\Plugin'", 703);
    }
}