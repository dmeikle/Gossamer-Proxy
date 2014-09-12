<?php


namespace core\http;

class ErrorResponse extends AbstractHTTP
{
    private $errorCode = null;
    
    private $errorMessage = null;
    
    
    
    public function getResponseHeader() {
        return header("HTTP/1.1 " . $result['code'] . " " . $result['message']);
    }
}
