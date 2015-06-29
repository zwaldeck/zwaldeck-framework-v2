<?php

namespace Zwaldeck\Plugins\FrameworkPlugin\Routing;

use Zwaldeck\Core\DependencyInjection\ContainerAware;
use Zwaldeck\Core\Exceptions\ControllerClassNotFoundException;
use Zwaldeck\Core\Exceptions\InvalidControllerClassException;
use Zwaldeck\Core\Exceptions\NoSuchActionException;
use Zwaldeck\Core\File\Parser\RoutingParser;
use Zwaldeck\Core\Http\Request;
use Zwaldeck\Core\Http\Response;
use Zwaldeck\Core\Utils\StringUtils;

/**
 * Class Router
 * @package Zwaldeck\Plugins\FrameworkPlugin\Routing
 */
class Router extends ContainerAware
{

    /**
     * @var array
     */
    private $routes;

    /**
     * @param array $routeParsers
     */
    public function __construct(array $routeParsers)
    {
        $this->routes = array();
        /** @var RoutingParser $routeParser */
        foreach ($routeParsers as $routeParser) {
            foreach ($routeParser->getRoutes() as $route) {
                $this->routes[] = $route;
            }
        }
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function doRouting(Request $request)
    {
        $requestURI = strtolower($request->getUri());
        /** @var Route $route */
        foreach ($this->routes as $route) {
            if (StringUtils::contains($route->getUri(), '{') && StringUtils::contains($route->getUri(), '}')) {
                $partsRoute = array_values(array_filter(explode('/', $route->getUri())));
                $partsURI = array_values(array_filter(explode('/', $requestURI)));
                $vars = array();
                if(count($partsRoute) == count($partsURI)) {
                    $good = true;
                    for($i = 0; $i < count($partsRoute); $i++) {
                        if(StringUtils::contains($partsRoute[$i], '{') && StringUtils::contains($partsRoute[$i], '}')) {
                            $vars[rtrim(ltrim($partsRoute[$i], '{'), '}')] = $partsURI[$i];
                        }
                        else if(strtolower($partsRoute[$i]) !== strtolower($partsURI[$i])) {
                            break;
                        }
                    }

                    if($good) {
                        return $this->dispatchRoute($route, $request, $vars);
                    }
                }
            } else {
                if (strtolower($route->getUri()) === $requestURI) {
                    return $this->dispatchRoute($route, $request);
                }
            }
        }
    }

    /**
     * @param Route $route
     * @param Request $request
     * @param array $params
     * @return mixed
     * @throws ControllerClassNotFoundException
     * @throws InvalidControllerClassException
     * @throws NoSuchActionException
     */
    private function dispatchRoute(Route $route, Request $request, array $params = array())
    {
        try {
            $refObj = new \ReflectionClass($route->getControllerClass());
        }catch (\Exception $ex) {
            throw new ControllerClassNotFoundException($route->getControllerClass());
        }

        if (!$refObj->isSubclassOf('Zwaldeck\\Core\\Controller\\Controller')) {
            throw new InvalidControllerClassException($route->getControllerClass());
        }

        if(!$refObj->hasMethod($route->getAction())) {
            throw new NoSuchActionException($route->getControllerClass(), $route->getAction());
        }

        //$refMethod = new \ReflectionMethod($route->getControllerClass(), $route->getAction());

        $controller = $refObj->newInstanceArgs(array($request));
        $controller->setContainer($this->container);

        return call_user_func_array(array($controller, $route->getAction()), $params);
    }
}