<?php

namespace core\http;

use exceptions\InvalidServerIdException;


class HTTPRequest extends AbstractHTTP
{
    
    protected $postParameters = null;
    
    protected $requestParameters = null;
    
    protected $parameters = array();
    
    protected $queryString = array();
    
    public function __construct($requestParameters = null, $pattern = '') {

       $uri = __REQUEST_URI;       
       $filter = $this->parseURIParams($pattern);
       $this->postParameters = $_POST;
       $this->formatQueryString();
       $params = $this->getParams($filter, $uri);
       
       if(array_key_exists('HTTP_REFERER', $_SERVER)) {
           $this->setAttribute('HTTP_REFERER', $_SERVER["HTTP_REFERER"]);
       }
       
       $this->requestParameters = $params;
    }
    
    public function getQueryParameter($key) {
        if(array_key_exists($key, $this->queryString)) {
            return $this->queryString[$key];
        }
        
        return null;
    }
    
    private function formatQueryString() {
        $temp = explode('&', $_SERVER['QUERY_STRING']);
        foreach($temp as $row) {
            $pieces = explode('=', $row);
            $pieces = array_filter($pieces);
            if(is_array($pieces) && count($pieces) > 0) {
                $this->queryString[$pieces[0]] = $pieces[1];
            }
            
        }
    }
    
    private function getParams($filter, $uri) {
        if(substr($filter, 0, 1) == '/' && substr($uri, 0, 1) != '/') {
            $filter = substr($filter, 1); //knock the preceding '/' if it's not there - varies from server to server
        }
        //array filter knocked off any '0' value, so it has been removed
        //$params = array_filter(explode('/', str_replace($filter, '', $uri)));
      
        $params = explode('/', str_replace($filter, '', $uri));
        if(current($params) == '') {
           array_shift($params);
        }
        return $params;
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
    
    public function getPostParameter($key) {
        if(array_key_exists($key, $this->postParameters)) {
            return $this->postParameters[$key];
        }
        
        return null;
    }
   
    public function getPost() {
        return $this->postParameters;
    }
}


