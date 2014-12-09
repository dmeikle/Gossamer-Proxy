<?php

namespace core\http;

use Monolog\Logger;

class AbstractHTTP
{
    protected $logger = null;
    
    protected $headers = null;
    
    protected $contentType = 'application/json';
    
    protected $method = null;
    
    protected $attributes = array();
    
   
    public function getAttributes() {
        return $this->attributes;
    }
    
    public function setAttribute($key, $value) {
        $this->attributes[$key] = $value;
    }
    
    
}
