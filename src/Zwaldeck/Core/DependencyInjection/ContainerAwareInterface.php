<?php

namespace Zwaldeck\Core\DependencyInjection;

/**
 * Class ContainerAwareInterface
 * @package Zwaldeck\Core\DependencyInjection
 */
interface ContainerAwareInterface {

    public function setContainer(ContainerInterface $container);
}