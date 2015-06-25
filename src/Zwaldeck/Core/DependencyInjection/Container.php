<?php

namespace Zwaldeck\Core\DependencyInjection;
use Zwaldeck\Core\Exceptions\NoSuchParameterException;
use Zwaldeck\Core\Exceptions\NoSuchServiceException;
use Zwaldeck\Core\Http\ParameterMap;

/**
 * Class Container
 * @package Zwaldeck\Core\DependencyInjection
 */
class Container implements ContainerInterface{

    /**
     * @var array
     */
    private $services;

    /**
     * @var ParameterMap
     */
    private $parameters;

    public function __construct() {
        $this->services = array();
        $this->parameters = new ParameterMap();
    }

    /**
     * does not override!
     *
     * @param string $name
     * @param Object $service
     */
    public function addService($name, $service)
    {
        if(!$this->hasService($name)) {
            $this->services[$name] = $service;
        }
    }

    /**
     * @param string $name
     * @return Object
     * @throws NoSuchServiceException
     */
    public function getService($name)
    {
        if(!$this->hasService($name)) {
            throw new NoSuchServiceException($name);
        }

        return $this->services[$name];
    }

    /**
     * @return array
     */
    public function getServices()
    {
        return $this->services;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasService($name)
    {
        return array_key_exists($name, $this->services);
    }

    /**
     * Overrides old value if it already exists
     *
     * @param string $name
     * @param mixed $value
     */
    public function addParameter($name, $value)
    {
        $this->parameters[$name] = $value;
    }

    /**
     * Overrides old value if it already exists
     *
     * @param array $parameters
     */
    public function addParameters(array $parameters)
    {
        foreach($parameters as $name => $param) {
            $this->parameters->addParameter($name, $param);
        }
    }

    /**
     * @param string $name
     * @return mixed
     * @throws NoSuchParameterException
     */
    public function getParameter($name)
    {
        if(!$this->hasParameter($name)) {
            throw new NoSuchParameterException($name);
        }

        return $this->parameters->getParameter($name);
    }

    /**
     * @return ParameterMap
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasParameter($name)
    {
        return $this->parameters->has($name);
    }
}