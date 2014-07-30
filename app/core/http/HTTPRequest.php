<?php

namespace core\http;

use exceptions\InvalidServerIdException;


class HTTPRequest extends AbstractHTTP
{
    
    protected $postParameters = null;
    
    protected $requestParameters = null;
    
    protected $parameters = array();
    
    public function __construct($requestParameters = null, $pattern = '') {

       $uri = $_SERVER['REQUEST_URI'];       
       $filter = $this->parseURIParams($pattern);
       $this->postParameters = $_POST;
       //array filter knocked off any '0' value, so it has been removed
       //$params = array_filter(explode('/', str_replace($filter, '', $uri)));
       
       $params = explode('/', str_replace($filter, '', $uri));
       if(current($params) == '') {
           array_shift($params);
       }
       
       $this->requestParameters = $params;
    }
    
    private function parseURIParams($pattern) {
        $pieces = explode('/', $pattern);
        $retval = '';
        foreach($pieces as $chunk) {
            if('*' != $chunk ) {
                $retval .= '/' . $chunk;
            }
        }    
        
        return $retval;
    }
    
    public function getHeader($headerName) {
        return $this->headers[$headerName];
    }
    private function init() {
     
        $this->headers = getallheaders();
        $this->attributes['ipAddress'] = $_SERVER['REMOTE_ADDR'];

    }
    
    
    public function setAttribute($key, $value) {
       
        $this->attributes[$key] = $value;
    }
    
    public function getAttribute($key) {
        if(array_key_exists($key, $this->attributes)) {
            return $this->attributes[$key];
        }
        
        return null;
    }
    
    public function getParameters() {
        return $this->requestParameters;
    }
    
    public function getParameter($key) {
        if(array_key_exists($key, $this->requestParameters)) {
            return $this->requestParameters[$key];
        }
        
        return null;
    }
    
    public function getPostParemeter($key) {
        if(array_key_exists($key, $this->postParameters)) {
            return $this->postParameters[$key];
        }
        
        return null;
    }
   
    public function getPost() {
        return $this->postParameters;
    }
}


