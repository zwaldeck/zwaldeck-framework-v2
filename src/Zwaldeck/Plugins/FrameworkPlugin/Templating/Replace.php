<?php

namespace Zwaldeck\Plugins\FrameworkPlugin\Templating;

/**
 * Class Replace
 * @package Zwaldeck\Plugins\FrameworkPlugin\Templating
 */
class Replace {

    /**
     * @var int
     */
    private $position;

    /**
     * @var string
     */
    private $varName;

    /**
     * @param int $position
     * @param string $varName
     */
    public function __construct($position, $varName) {
        $this->position = $position;
        $this->varName = $varName;
    }

    /**
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @return string
     */
    public function getVarName()
    {
        return $this->varName;
    }
}