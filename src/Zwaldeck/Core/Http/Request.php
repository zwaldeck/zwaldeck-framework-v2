<?php

namespace Zwaldeck\Core\Http;

/**+
 * Class Request
 * @package Zwaldeck\Core\Http
 */
class Request
{

    private $method;
    private $query;
    private $post;
    private $headers;
    private $files;
    private $cookies;

    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->query = new ParameterMap($_GET);
        $this->post = new ParameterMap($_POST);
        //todo headers are not right!!!
        $this->headers = new ParameterMap($_SERVER);
        $this->cookies = new ParameterMap($_COOKIE);
        //TODO files

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
    public function getHost() {
        return $this->headers->getParameter('HTTP_HOST');
    }

    /**
     * @return bool
     */
    public function isSecure() {
        return $this->headers->getParameter('REQUEST_SCHEME') === 'https';
    }

    /**
     * @return string
     */
    public function getMethod() {
        return $this->method;
    }

    /**
     * @param $method
     * @return bool
     */
    public function isMethod($method) {
        return $this->method === strtoupper($method);
    }

    /**
     * @return array|null|string
     */
    public function getUri() {
        return $this->headers->getParameter('REQUEST_URI');
    }
}