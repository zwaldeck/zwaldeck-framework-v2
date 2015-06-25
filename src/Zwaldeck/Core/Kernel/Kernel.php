<?php

namespace Zwaldeck\Core\Kernel;

use Zwaldeck\Core\DependencyInjection\Container;
use Zwaldeck\Core\DependencyInjection\ContainerInterface;
use Zwaldeck\Core\DependencyInjection\Service\ServiceLoader;
use Zwaldeck\Core\Exceptions\MalformedPluginClassException;
use Zwaldeck\Core\Http\Request;
use Zwaldeck\Core\Http\Response;
use Zwaldeck\Core\Plugin\Plugin;
use Zwaldeck\Core\Utils\StringUtils;
use Zwaldeck\Plugins\FrameworkPlugin\Routing\Router;


/**
 * Class Kernel
 * @package Zwaldeck\Core\Kernel
 */
abstract class Kernel implements KernelInterface
{

    const VERSION = "0.0.1 pre-alpha";

    protected $plugins;
    protected $environment;
    protected $debug;
    protected $rootDir;
    protected $booted;
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var array
     */
    protected $parsers;

    public function __construct($rootDir, $environment, $debug)
    {
        $this->plugins = array();
        $this->rootDir = $rootDir;
        $this->environment = $environment;
        $this->debug = $debug;
        $this->container = null;
        $this->booted = false;
        $this->parsers = array();
    }

    public function boot()
    {
        $this->container = new Container();

        //load plugins
        $this->registerPlugins();

        //load parsers
        $this->loadParsers();

        //load DI container
        $this->loadContainer();

        $this->booted = true;
    }

    public function getRootDir()
    {
        return $this->rootDir;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function handleRequest(Request $request)
    {

        if (!$this->booted) {
            $this->boot();
        }

        return $this->container->getService('zwaldeck.httpKernel')->handle($request);
    }

    private function registerPlugins()
    {
        $srcRoot = $this->rootDir . '/../src/';
        $dirs = scandir($srcRoot);
        foreach ($dirs as $dir) {
            if ($dir !== '.' && $dir !== '..') {
                $pluginsDir = $srcRoot . $dir . '/Plugins';
                if (file_exists($pluginsDir)) {
                    foreach (scandir($pluginsDir) as $pluginDir) {
                        if ($pluginDir !== '.' && $pluginDir !== '..') {
                            foreach (scandir($pluginsDir . '/' . $pluginDir) as $pluginFile) {
                                if (StringUtils::endsWith($pluginFile, 'Plugin.php')) {
                                    $className = str_replace('/', '\\', $dir.'/Plugins').'\\'.str_replace('/', '\\', $pluginDir).'\\'.rtrim($pluginFile, '.php');
                                    $instance = new $className();
                                    if ($instance instanceof Plugin) {
                                        $instance->setContainer($this->container);
                                        $this->plugins[$instance->getName()] = $instance;
                                    }
                                    else {
                                        throw new MalformedPluginClassException($pluginFile);
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    private function loadContainer()
    {
        //we add router this way to the container because it needs that array with parsers
        $this->container->addService("zwaldeck.router", new Router($this->parsers["routes"]));
        $serviceLoader = new ServiceLoader($this->parsers["services"]);
        $serviceLoader->loadServices($this->container);
    }

    private function loadParsers() {
        $serviceParsers  = array();
        $routeParsers = array();
        /** @var Plugin $plugin */
        foreach($this->plugins as $plugin) {
            $serviceParser = $plugin->getServiceParser();
            if($serviceParser != null) {
                $serviceParsers[] = $serviceParser;
            }

            $routeParser = $plugin->getRouteParser();
            if($routeParser != null) {
                $routeParsers[] = $routeParser;
            }
        }

        $this->parsers["services"] = $serviceParsers;
        $this->parsers["routes"] = $routeParsers;
    }



}