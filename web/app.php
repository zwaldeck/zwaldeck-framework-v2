<?php
use Zwaldeck\Core\Http\Request;
use Zwaldeck\Core\Kernel\AutoLoader;

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "../src/Zwaldeck/Core/Kernel/AutoLoader.php";
$autoLoader = new AutoLoader();

require_once "../app/UserKernel.php";
$kernel = new UserKernel($autoLoader->getRootDir(), "dev", true);

$request = new Request();
$response = $kernel->handleRequest($request);
$response->send();
