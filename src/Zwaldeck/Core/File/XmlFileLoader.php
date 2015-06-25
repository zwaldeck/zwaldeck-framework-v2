<?php

namespace Zwaldeck\Core\File;

/**
 * Class XmlFileLoader
 * @package Zwaldeck\Core\File
 */
class XmlFileLoader extends FileLoader{

    protected $root;

    public function parse()
    {
        //parse it to a main object with Simple xml
        $this->root = new \SimpleXMLElement($this->content);
    }
}