<?php

namespace Zwaldeck\Core\File\Parser;

/**
 * Class ServiceParser
 * @package Zwaldeck\Core\File\Parser
 */
interface RoutingParser {
    public function parseRoutes();
    public function getRoutes();
}