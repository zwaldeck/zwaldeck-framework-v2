<?php

namespace Zwaldeck\Core\Kernel;

use Zwaldeck\Core\Http\Request;

/**
 * Interface KernelInterface
 * @package Zwaldeck\Core\Kernel
 */
interface KernelInterface {

    public function loadPlugins();
    public function boot();
    public function getRootDir();
    public function handleRequest(Request $request);
}