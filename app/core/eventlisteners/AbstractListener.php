<?php

namespace core\eventlisteners;

use Monolog\Logger;
use core\http\HTTPRequest;


class AbstractListener
{
    protected $logger = null;
    
    protected $httpRequest = null;
    
    public function __construct(Logger $logger, HttpRequest $httpRequest = null) {
        $this->logger = $logger;
        $this->httpRequest = $httpRequest;
    }
    
    public function execute($state, $params) {
        $method = 'on_' . $state;
        $this->logger->addDebug('checking listener for method: ' . $method);
         if (method_exists($this, $method)) {
            call_user_func_array(array($this, $method), array($params));        
        }
    }
}
