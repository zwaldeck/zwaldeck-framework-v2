<?php

namespace Zwaldeck\Core\Kernel;

/**
 * Class AutoLoader
 * @package Zwaldeck\Core\Kernel
 */
class AutoLoader
{

    /**
     * The root dir points to /web folder
     *
     * @var string
     */
    private $rootDir;

    public function __construct() {
        spl_autoload_register(array($this, "autoLoad"));
        $this->rootDir = getcwd();
    }

    /**
     * @param $class
     * @throws \Exception
     */
    public function autoLoad($class)
    {
        $class = str_replace('\\', '/', $class);
        $file = $this->rootDir."/../src/".$class.'.php';
        if(file_exists($file)) {
            require_once $file;
        }
        else {
            throw new \Exception("Could not load '{$class}' because file '{$file}' does not exists!");
        }
    }

    public function getRootDir() {
        return $this->rootDir;
    }
}