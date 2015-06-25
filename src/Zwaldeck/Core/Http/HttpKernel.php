<?php

namespace Zwaldeck\Core\Http;


use Zwaldeck\Core\DependencyInjection\ContainerAware;
use Zwaldeck\Plugins\FrameworkPlugin\Routing\Router;

/**
 * Class HttpKernel
 * @package Zwaldeck\Core\Http
 */
class HttpKernel extends ContainerAware {

    /**
     * @var Router
     */
    private $router;

    /**
     * @param Router $router
     */
    public function __construct(Router $router) {
        $this->router = $router;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function handle(Request $request) {
        try {
            return $this->router->doRouting($request);
        }catch (\Exception $ex) {
            var_dump($ex);
        }
    }
}