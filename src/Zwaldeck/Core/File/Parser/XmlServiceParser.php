<?php

namespace Zwaldeck\Core\File\Parser;

use Zwaldeck\Core\DependencyInjection\Service\Service;
use Zwaldeck\Core\File\XmlFileLoader;
use Zwaldeck\Core\Utils\StringUtils;

/**
 * Class XmlServiceParser
 * @package Zwaldeck\Core\File\Parser
 */
class XmlServiceParser extends XmlFileLoader implements ServiceParser
{

    private $services;

    public function __construct($file, $pluginNamespace)
    {

        $this->services = array();

        $this->loadFile($file,$pluginNamespace);
        $this->parse();

        $this->parseServices();

        $this->dispose();
    }

    public function parseServices()
    {
        foreach($this->root as $elem) {
            $service = new Service();
            $service->setName((string)$elem['name']);
            $service->setClass((string)$elem['class']);
            foreach($elem->{'con-arg'} as $arg) {
                $textValue = trim((string)$arg);
                if(!empty($textValue)) {
                    $service->addConstructorArg(trim((string)$arg));
                }
                else {
                    //we have an array or a service
                    if(isset($arg->service)) {
                        $service->addConstructorArg(trim((string)$arg->service));
                        $service->addDependency(count($service->getConstructorArg()) - 1, trim((string)$arg->service));

                    }
                    else {
                        $array = array();
                        foreach($arg->array->value as $arrayElem) {

                            if(isset($arrayElem['key'])) {
                                $array[(string)$arrayElem['key']] = trim((string)$arrayElem);
                            }
                            else {
                                $array[] = trim((string)$arrayElem);
                            }
                        }
                        $service->addConstructorArg($array);
                    }

                }
            }
            $this->services[] = $service;
        }
    }

    /**
     * @return array
     */
    public function getServices()
    {
        return $this->services;
    }
}