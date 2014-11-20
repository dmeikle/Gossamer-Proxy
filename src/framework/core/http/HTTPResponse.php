<?php

namespace core\http;


class HTTPResponse 
{
    private $attributes = null;
    
    private $version;
    
    private $statusCode;
    
    private $statusText;
    
    private $headers;
    
    private $content;
    
    public function __construct($content = null) {
        $this->content = $content;
    }
    
    public function setAttribute($key, $value) {
        $attributes = $this->getAttributes();
        
        $attributes[$key] = $value;
        
        $this->attributes = $attributes;
    }
    
    public function getAttribute($key) {
        if(array_key_exists($key, $this->getAttributes())) {
            $attributes = $this->getAttribute();
            return $attributes[$key];
        }
        
        return null;
    }
    
    private function getAttributes() {
        if(is_null($this->attributes)) {
            $this->attributes = array();
        }
        
        return $this->attributes;
    }
    
    /**
     * Returns the Response as an HTTP string.
     *
     * The string representation of the Response is the same as the
     * one that will be sent to the client only if the prepare() method
     * has been called before.
     *
     * @return string The Response as an HTTP string
     *
     * @see prepare()
     */
    public function __toString()
    {
        return
            sprintf('HTTP/%s %s %s', $this->version, $this->statusCode, $this->statusText)."\r\n".
            $this->headers."\r\n".
            $this->getContent();
    }
    
    public function getContent() {
        return $this->content;
    }
}
