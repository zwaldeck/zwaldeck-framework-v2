<?php

namespace Zwaldeck\Core\Http;

/**+
 * Class Request
 * @package Zwaldeck\Core\Http
 */
class Request
{
    /**
     * @var string
     */
    private $method;

    /**
     * @var ParameterMap
     */
    private $query;

    /**
     * @var ParameterMap
     */
    private $post;

    /**
     * @var ParameterMap
     */
    private $headers;

    private $files;

    /**
     * @var ParameterMap
     */
    private $cookies;

    private $protocol;

    private $requestURI;

    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->query = new ParameterMap($_GET);
        $this->post = new ParameterMap($_POST);
        $headers = array();
        foreach ($_SERVER as $name => $value) {
            if (substr($name, 0, 5) == 'HTTP_') {
                $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
            }
        }
        $this->headers = new ParameterMap($headers);
        $this->cookies = new ParameterMap($_COOKIE);
        //TODO files

        $this->protocol = $_SERVER['SERVER_PROTOCOL'];
        $this->requestURI = $_SERVER['REQUEST_URI'];

        //empty the super globals
        $_GET = array();
        $_POST = array();
        $_SERVER = array();
        $_COOKIE = array();
        $_FILES = array();
    }

    /**
     * @return ParameterMap
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * @return ParameterMap
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * @return ParameterMap
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @return mixed
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * @return ParameterMap
     */
    public function getCookies()
    {
        return $this->cookies;
    }

    /**
     * @return array|null|string
     */
    public function getHost()
    {
        return $this->headers->getParameter('HTTP_HOST');
    }

    /**
     * @return bool
     */
    public function isSecure()
    {
        return $this->headers->getParameter('REQUEST_SCHEME') === 'https';
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param $method
     * @return bool
     */
    public function isMethod($method)
    {
        return $this->method === strtoupper($method);
    }

    /**
     * @return array|null|string
     */
    public function getUri()
    {
        return $this->requestURI;
    }

    /**
     * @return mixed
     */
    public function getProtocol()
    {
        return $this->protocol;
    }

    /**
     * @param mixed $protocol
     */
    public function setProtocol($protocol)
    {
        $this->protocol = $protocol;
    }
}