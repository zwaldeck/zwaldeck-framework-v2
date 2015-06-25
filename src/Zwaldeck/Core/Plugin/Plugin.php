<?php

namespace Zwaldeck\Core\Plugin;
use Zwaldeck\Core\File\Parser\XmlRoutingParser;
use Zwaldeck\Core\File\Parser\XmlServiceParser;
use Zwaldeck\Core\Plugin\PluginInterface;
use Zwaldeck\Core\DependencyInjection\ContainerAware;

/**
 * Class Plugin
 * @package Zwaldeck\Core\Plugin
 */
abstract class Plugin extends ContainerAware implements PluginInterface {


    public function boot()
    {
    }

    public function getName()
    {
        $name = get_class($this);
        $pos = strrpos($name, '\\');

        return $pos === false ? $name :  substr($name, $pos + 1);
    }

    public function getNamespace()
    {
        $name = get_class($this);
        return substr($name, 0, strrpos($name, '\\'));
    }

    public function getPath()
    {
        $refObj = new \ReflectionObject($this);
        return dirname($refObj->getFileName());
    }

    public function registerCommand()
    {
        //command dir
    }

    public function getServiceParser()
    {
        $di = $this->getPath().'/Res/Config/di.xml';
        if(file_exists($di)) {
            return new XmlServiceParser($di, $this->getNamespace());
        }

        return null;
    }

    public function getRouteParser()
    {
        $routes = $this->getPath().'/Res/Config/routes.xml';
        if(file_exists($routes)) {
            return new XmlRoutingParser($routes,$this->getNamespace());
        }

        return null;
    }


}