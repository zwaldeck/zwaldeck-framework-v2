<?php

namespace Zwaldeck\Core\Controller;
use Zwaldeck\Core\DependencyInjection\ContainerAware;
use Zwaldeck\Core\Exceptions\NoSuchPluginException;
use Zwaldeck\Core\Http\Request;
use Zwaldeck\Core\Http\Response;
use Zwaldeck\Core\Plugin\PluginManager;

/**
 * Class Controller
 * @package Zwaldeck\Core\Controller
 */
abstract class Controller extends ContainerAware{

    /**
     * @var Request
     */
    protected $request;

    /**
     * @param Request $request
     */
    public function __construct(Request $request) {
        $this->request = $request;
    }

    //todo later with my own Templating engine
    protected function buildResponse($view, array $variables) {

        /** @var PluginManager $pluginManager */
        $pluginManager = $this->container->getService("zwaldeck.plugin_manager");
        $parts = explode('->',$view);//0: plugin, 1: folder, 2: actual view name
        $plugin = $pluginManager->getPlugin($parts[0]);
        if($plugin == null) {
            throw new NoSuchPluginException($parts[0]);
        }
        $actualView = $plugin->getPath().'/Res/Views/'.$parts[1].'/'.$parts[2].'.zwal.html';
        $renderedPage = $this->container->getService('zwaldeck.template_engine')->render($view, $actualView, $variables);
        return new Response($this->request, $renderedPage);
    }
}