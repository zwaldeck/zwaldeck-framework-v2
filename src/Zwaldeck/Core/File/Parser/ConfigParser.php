<?php

namespace Zwaldeck\Core\File\Parser;

/**
 * Class ConfigParser
 * @package Zwaldeck\Core\File\Parser
 */
interface ConfigParser {

    public function parseConfig();
    public function getConfig();
}