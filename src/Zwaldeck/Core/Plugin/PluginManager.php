<?php

namespace Zwaldeck\Core\Plugin;

/**
 * Class PluginManager
 * @package Zwaldeck\Core\Plugin
 */
class PluginManager {

    /**
     * @var array
     */
    private $plugins;

    /**
     * @param array $plugins
     */
    public function __construct(array $plugins) {
        $this->plugins = $plugins;
    }

    /**
     * @param $name
     * @return Plugin | null
     */
    public function getPlugin($name) {
        return $this->hasPlugin($name) ? $this->plugins[$name] : null;
    }

    /**
     * @param $name
     * @return bool
     */
    public function hasPlugin($name) {
        return array_key_exists($name, $this->plugins);
    }


}