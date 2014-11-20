<?php


namespace core\system;

use Monolog\Logger;
use components\validation\exceptions\RedirectKeyNotFoundException;
use libraries\utils\YAMLKeyParser;
use core\http\HTTPRequest;

/**
 * Description of Router
 *
 * @author davem
 */
class Router {
    
    private $logger = null;
    
    private $httpRequest = null;
    
    public function __construct(Logger $logger = null, HTTPRequest &$httpRequest) {
        $this->logger = $logger;
        $this->httpRequest = $httpRequest;
    }
    
    public function redirect($ymlkey) {
        $ymlURI = $this->getURLByYamlKey($ymlkey);
        if(is_null($ymlURI)) {
            throw new RedirectKeyNotFoundException('Validation Fail redirect key not found');
        }
        $redirectUrl =   $this->parseRequestUriParameters($this->httpRequest->getAttribute('HTTP_REFERER'), $ymlURI);
        
        if(!is_null($this->logger->addDebug('redirecting to ' . $redirectUrl)));
        /* Redirect browser */
        header("Location: /$redirectUrl");
        /* Make sure that code below does not get executed when we redirect. */
        exit;
    }
    
    private function getURLByYamlKey($ymlkey) {
        $loader = new YAMLKeyParser($this->logger);
        $node = $loader->getNodeByKey($ymlkey, 'routing');

        if(!is_null($node) && count($node) > 0) {
            return $node['pattern'];
        }
    }
   
    private function parseRequestUriParameters($uri, $ymlURI) {        
        $uriList = explode('/', $uri);
        $rawUriList = explode('/', $ymlURI);

        $rawList = implode('/', array_slice($uriList, -(count($rawUriList))));

        return $rawList;
    }

        
    
}
