<?php

namespace Zwaldeck\Core\File\Parser;
use Zwaldeck\Core\File\XmlFileLoader;
use Zwaldeck\Plugins\FrameworkPlugin\Routing\Route;

/**
 * Class XmlRoutingParser
 * @package Zwaldeck\Core\File\Parser
 */
class XmlRoutingParser extends XmlFileLoader implements RoutingParser{

    private $routes = array();

    public function __construct($file,$pluginNamespace) {
        $this->routes = array();

        $this->loadFile($file,$pluginNamespace);
        $this->parse();

        $this->parseRoutes();

        $this->dispose();
    }

    public function parseRoutes()
    {
        foreach($this->root->route as $route) {
            $routeObj = new Route();
            $routeObj->setUri((string)$route->uri);
            $routeObj->setController((string)$route->controller);
            $routeObj->setControllerClass($this->pluginNamespace.'\\Controller\\'.$route->controller);
            $routeObj->setAction((string)$route->action);
            $this->routes[] = $routeObj;
        }
    }

    public function getRoutes()
    {
        return $this->routes;
    }
}