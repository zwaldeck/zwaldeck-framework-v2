<?php

namespace Company\Plugins\FirstPlugin\Controller;
use Zwaldeck\Core\Controller\Controller;

/**
 * Class HomeController
 * @package Company\Plugins\FirstPlugin\Controller
 */
class HomeController extends Controller {

    public function welcomeAction($firstName, $lastName) {
        return $this->buildResponse('<h1>Welcome '. $firstName .' '. $lastName.'</h1>');
    }
}