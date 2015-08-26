<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\http;

/**
 * the HTTPRequest object we will pass around to access request data
 * 
 * @author Dave Meikle
 */
class HTTPRequest extends AbstractHTTP {

    protected $postParameters = null;
    protected $requestParameters = null;
    protected $parameters = array();
    protected $queryString = array();
    protected $uri = null;
    protected $modules = array();
    protected $nodeConfig;
    
    /**
     * 
     * @param type $requestParameters
     * @param type $pattern
     */
    public function __construct($requestParameters = null, $pattern = '') {

        $uri = __REQUEST_URI;

        $filter = $this->parseURIParams($pattern);
        $this->postParameters = $_POST;
        $this->formatQueryString();
        $params = $this->getParams($filter, $uri);

//pr($requestParameters);
        if (array_key_exists('HTTP_REFERER', $_SERVER)) {
            $this->setAttribute('HTTP_REFERER', $_SERVER["HTTP_REFERER"]);
        }

        $this->uri = $uri;
        $this->requestParameters = $params;
    }

    public function getRestParameters() {
        return json_decode(file_get_contents("php://input"), true);
    }
    
    public function setNodeConfig(array $config) {
        $this->nodeConfig = $config;
    }
    
    public function getNodeConfig() {
        return $this->nodeConfig;
    }
    
    /**
     * returns a query param based on key
     * 
     * @param type $key
     * 
     * @return string|null
     */
    public function getQueryParameter($key) {
        if (array_key_exists($key, $this->queryString)) {
            return $this->queryString[$key];
        }

        return null;
    }
    
    public function getQueryParameters() {
        return $this->queryString;
    }

    /**
     * formats the query string into a readable array
     */
    protected function formatQueryString() {
        $temp = explode('&', $_SERVER['QUERY_STRING']);
    
        foreach ($temp as $row) {
            $pieces = explode('=', $row);
            //$pieces = array_filter($pieces);
           
            if (is_array($pieces) && count($pieces) > 1) {
                $this->queryString[$pieces[0]] = $pieces[1];
            }
        }
    }

    /**
     * removes the base uri and returns only the uri pieces pertinent to the 
     * request that are used as request parameters now
     * 
     * @param string $filter
     * @param string $uri
     * 
     * @return array
     */
    protected function getParams($filter, $uri) {

        if (substr($filter, 0, 1) == '/' && substr($uri, 0, 1) != '/') {
            $filter = substr($filter, 1); //knock the preceding '/' if it's not there - varies from server to server
        }
        //array filter knocked off any '0' value, so it has been removed
        //$params = array_filter(explode('/', str_replace($filter, '', $uri)));

        $uri = substr($uri, strlen($filter));

        $params = explode('/', $uri);

        if (current($params) == '') {
            array_shift($params);
        }

        return $params;
    }

    /**
     * 
     * @param string $pattern
     * 
     * @return string
     */
    protected function parseURIParams($pattern) {

        $pieces = explode('/', $pattern);
        $retval = '';
        foreach ($pieces as $chunk) {
            if ('*' != $chunk) {
                $retval .= '/' . $chunk;
            }
        }

        return $retval;
    }

    /**
     * accessor
     * 
     * @param type $headerName
     * 
     * @return string
     */
    public function getHeader($headerName) {
        return $this->headers[$headerName];
    }

    /**
     * initialize values
     */
    protected function init() {

        $this->headers = getallheaders();
        $this->attributes['ipAddress'] = $_SERVER['REMOTE_ADDR'];
    }

    /**
     * accessor
     * 
     * @param string $key
     * @param string $value
     */
    public function setAttribute($key, $value) {

        $this->attributes[$key] = $value;
    }

    /**
     * accessor
     * 
     * @param string $key
     * @return string
     */
    public function getAttribute($key) {
        if (array_key_exists($key, $this->attributes)) {
            return $this->attributes[$key];
        }

        return null;
    }

    /**
     * 
     * @return array
     */
    public function getParameters() {
        return $this->requestParameters;
    }

    /**
     * returns a value from the request string
     * @param string $key
     * @return string
     */
    public function getParameter($key) {
        if (array_key_exists($key, $this->requestParameters)) {
            return $this->requestParameters[$key];
        }

        return null;
    }

    /**
     * returns a value that has been posted
     * @param string $key
     * @return string|null
     */
    public function getPostParameter($key) {

        if (array_key_exists($key, $this->postParameters)) {
            return $this->postParameters[$key];
        }

        return null;
    }

    /**
     * allows a controller to add unique identification keys that may not be
     * hidden in a form as part of site security
     * 
     * @param string $key
     * @param mixed $value
     */
    public function setPostParameter($key, $value) {
        $this->postParameters[$key] = $value;
    }
    
    /**
     * accessor
     * 
     * @return array
     */
    public function getPost() {
        return $this->postParameters;
    }

    /**
     * 
     * @return string
     */
    public function getUri() {
        return $this->uri;
    }

    public function addModule($module) {
        if(!in_array($module, $this->modules)) {
            $this->modules[] = $module;
        }
    }
    
    public function getModules() {
        return $this->modules;
    }
}
