<?php
namespace Zwaldeck\Core\Http;

use Traversable;

/**
 * Class ParameterMap
 * @package Zwaldeck\Core\Http
 */
class ParameterMap implements \IteratorAggregate, \Countable{

    /**
     * @var array
     */
    private $parameters;

    /**
     * @param array $parameters
     */
    public function __construct(array $parameters = array()) {
        $this->parameters = $parameters;
    }

    /**
     * If parameter already exists it overrides
     *
     * @param array $parameters
     */
    public function addParameters(array $parameters) {
        foreach($parameters as $name => $value) {
            $this->parameters[$name] = $value;
        }
    }

    /**
     * If parameter already exists it overrides
     *
     * @param $name
     * @param $value
     */
    public function addParameter($name, $value) {
       $this->parameters[$name] = $value;
    }

    /**
     * Returns all parameters
     *
     * @return array
     */
    public function getParameters() {
        return $this->parameters;
    }

    /**
     * Returns all parameter keys
     *
     * @return array
     */
    public function getParameterKeys() {
        return array_keys($this->parameters);
    }

    /**
     * Returns the parameter and if not fount null
     *
     * @param $key
     * @return string|array|null
     */
    public function getParameter($key) {
        return $this->has($key) ? $this->parameters[$key] : null;
    }

    /**
     * Return true if key exists
     *
     * @param $key
     * @return bool
     */
    public function has($key) {
        return array_key_exists($key, $this->parameters);
    }

    /**
     * Removes the value for that key
     *
     * @param $key
     */
    public function remove($key)  {
        if($this->has($key)) {
            unset($this->parameters[$key]);
        }
    }

    /**
     * Get the iterator
     *
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->parameters);
    }

    /**
     * Get the size of the parameterMap
     *
     * @return int
     */
    public function count()
    {
        return count($this->parameters);
    }
}