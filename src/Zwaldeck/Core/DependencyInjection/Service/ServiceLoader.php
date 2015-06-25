<?php

namespace Zwaldeck\Core\DependencyInjection\Service;

use Zwaldeck\Core\DependencyInjection\ContainerInterface;
use Zwaldeck\Core\File\Parser\ServiceParser;

/**
 * Class ServiceLoader
 * @package Zwaldeck\Core\DependencyInjection\Service
 */
class ServiceLoader
{

    /**
     * @var array
     */
    private $servicesToLoad;

    /**
     * @param array $serviceParsers
     */
    public function __construct(array $serviceParsers)
    {

        $this->servicesToLoad = array();
        /** @var ServiceParser $parser */
        foreach ($serviceParsers as $parser) {
            foreach ($parser->getServices() as $service) {
                $this->servicesToLoad[] = $service;
            }
        }
    }

    /**
     * Check if we can load the service
     * If we can load it, load it and remove from $servicesToLoad
     * If loop is done ans $servicesToLoad is not empty we call the method again
     *
     * @param ContainerInterface $container passed by reference
     */
    public function loadServices(ContainerInterface &$container)
    {
        for ($i = 0; $i < count($this->servicesToLoad); $i++) {
            /** @var Service $service */
            $service = $this->servicesToLoad[$i];
            if ($this->canLoadService($service, $container)) {
                $realArg = array();
                foreach ($service->getConstructorArg() as $index => $arg) {
                    if (array_key_exists($index, $service->getDependsOn())) {
                        $realArg[] = $container->getService($arg);
                    } else {
                        $realArg[] = $arg;
                    }
                }

                //todo further checking if constructor args are ok
                $reflectionClass = new \ReflectionClass($service->getClass());
                $serviceObj = $reflectionClass->newInstanceArgs($realArg);
                if ($reflectionClass->implementsInterface("Zwaldeck\\Core\\DependencyInjection\\ContainerAwareInterface")) {
                    $serviceObj->setContainer($container);
                }
                $container->addService($service->getName(), $serviceObj);
                unset($this->servicesToLoad[$i]);
                $this->servicesToLoad = array_values($this->servicesToLoad);
            }
        }

        if (!empty($this->servicesToLoad)) {
            $this->loadServices($container);
        }
    }

    /**
     * @param Service $service
     * @param ContainerInterface $container
     * @return bool
     */
    private function canLoadService(Service $service, ContainerInterface $container)
    {
        $dependencies = $service->getDependsOn();
        if (empty($dependencies)) {
            return true;
        }

        foreach ($dependencies as $dependency) {
            if (!$container->hasService($dependency)) {
                return false;
            }
        }

        return true;
    }
}