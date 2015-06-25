<?php

namespace Company\Plugins\FirstPlugin\Controller;
use Zwaldeck\Core\Controller\Controller;

/**
 * Class TestController
 * @package Company\Plugins\FirstPlugin\Controller
 */
class TestController extends Controller {


    public function testAction() {

        return $this->buildResponse("<h1>Awesome</h1>");
    }
}