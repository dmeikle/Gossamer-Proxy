<?php

namespace core\http;

class RequestFormatter
{
    
    public function __construct() {
        
    }
    

    public function getRequestParameters() {
        $httpRequest->getAttribute('HTTP_REFERER');
    }
    
}
