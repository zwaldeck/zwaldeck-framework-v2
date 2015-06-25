<?php

namespace Zwaldeck\Core\Controller;
use Zwaldeck\Core\DependencyInjection\ContainerAware;
use Zwaldeck\Core\Http\Request;
use Zwaldeck\Core\Http\Response;

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
    protected function buildResponse($content/*This is temp*/) {
        return new Response($this->request, $content);
    }
}