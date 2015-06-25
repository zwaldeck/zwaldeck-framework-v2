<?php

namespace Zwaldeck\Core\File;
use Zwaldeck\Core\Exceptions\NoSuchFileException;

/**
 * Class FileLoader
 * @package Zwaldeck\Core\File
 */
abstract class FileLoader implements FileLoaderInterface {

    protected $pluginNamespace;
    protected $content;
    protected $disposed = false;

    public function loadFile($file, $pluginNamespace)
    {
        $this->pluginNamespace = $pluginNamespace;
        if(!file_exists($file)) {
            throw new NoSuchFileException($file);
        }

        $this->content =  file_get_contents($file);
    }

    public function dispose()
    {
        $this->content = null;
        $this->disposed = true;
    }


}