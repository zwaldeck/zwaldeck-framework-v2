<?php

namespace Zwaldeck\Core\File;

/**
 * Interface FileLoaderInterface
 * @package Zwaldeck\Core\File
 */
interface FileLoaderInterface {

    public function loadFile($file,$pluginNamespace);
    public function parse();
    public function dispose();

}