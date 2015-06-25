<?php

namespace Zwaldeck\Core\DependencyInjection;

/**
 * Class ContainerInterface
 * @package Zwaldeck\Core\DependencyInjection
 */
interface ContainerInterface {

    //services
    public function addService($name, $service);
    public function getService($name);
    public function getServices();
    public function hasService($name);

    //parameters
    public function addParameter($name, $value);
    public function addParameters(array $parameters);
    public function getParameter($name);
    public function getParameters();
    public function hasParameter($name);
}