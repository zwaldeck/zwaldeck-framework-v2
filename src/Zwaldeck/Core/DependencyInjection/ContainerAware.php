<?php

namespace Zwaldeck\Core\DependencyInjection;

/**
 * Class ContainerAware
 * @package Zwaldeck\Core\DependencyInjection
 */
abstract class ContainerAware implements ContainerAwareInterface{

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @param ContainerInterface $container
     */
    public function setContainer(ContainerInterface $container)
    {
        $this->container = $container;
    }


}