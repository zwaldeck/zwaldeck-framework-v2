<?php

namespace Zwaldeck\Core\DependencyInjection\Service;

/**
 * Class Service
 * @package Zwaldeck\Core\DependencyInjection\Service
 */
class Service {

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $class;

    /**
     * @var array
     */
    private $constructorArg;

    /**
     * All the services it needs
     *
     * @var array
     */
    private $dependsOn;

    public function __construct()
    {
        $this->constructorArg = array();
        $this->dependsOn = array();
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * @param mixed $class
     */
    public function setClass($class)
    {
        $this->class = $class;
    }

    /**
     * @return mixed
     */
    public function getConstructorArg()
    {
        return $this->constructorArg;
    }

    /**
     * @param mixed $constructorArg
     */
    public function setConstructorArg($constructorArg)
    {
        $this->constructorArg = $constructorArg;
    }

    public function addConstructorArg($argument) {
        $this->constructorArg[] = $argument;
    }

    /**
     * @return array
     */
    public function getDependsOn()
    {
        return $this->dependsOn;
    }

    /**
     * @param array $dependsOn
     */
    public function setDependsOn($dependsOn)
    {
        $this->dependsOn = $dependsOn;
    }

    /**
     * @param int $index this is also the index from constructorArg
     * @param string $dependencyName
     */
    public function addDependency($index, $dependencyName) {
        $this->dependsOn[$index] = $dependencyName;
    }
}