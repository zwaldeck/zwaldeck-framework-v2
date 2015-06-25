<?php

namespace Company\Plugins\FirstPlugin\Tmp;
use Zwaldeck\Core\DependencyInjection\ContainerAware;

/**
 * Class TestService
 * @package Zwaldeck\Plugins\FrameworkPlugin\Tmp
 */
class TestService extends ContainerAware{

    private $int1;
    private $string1;
    private $array;
    private $testService;


    public function __construct($int1, $string1, array $array, TestService $testService = null) {
        $this->int1 = $int1;
        $this->string1 = $string1;
        $this->array = $array;
        $this->testService = $testService;
    }
}