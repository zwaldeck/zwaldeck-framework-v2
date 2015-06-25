<?php
namespace Zwaldeck\Core\Plugin;

/**
 * Interface PluginInterface
 * @package Zwaldeck\Plugin\FrameworkPlugin
 */
interface PluginInterface {

    public function boot();
    public function getName();
    public function getNamespace();
    public function getPath();
    public function registerCommand();
    public function getServiceParser();
    public function getRouteParser();

}