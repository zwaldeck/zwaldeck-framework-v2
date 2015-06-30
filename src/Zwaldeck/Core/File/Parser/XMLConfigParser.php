<?php

namespace Zwaldeck\Core\File\Parser;
use Zwaldeck\Core\File\XmlFileLoader;

/**
 * Class XMLConfigParser
 * @package Zwaldeck\Core\File\Parser
 */
class XMLConfigParser extends XmlFileLoader implements ConfigParser {

    /**
     * @var array
     */
    private $config = array();

    public function __construct($file) {
        $this->loadFile($file);
        $this->parse();
        $this->parseConfig();
    }

    public function parseConfig()
    {
        //convert xml to array
        $this->config = json_decode(json_encode($this->root), true);
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        return $this->config;
    }
}