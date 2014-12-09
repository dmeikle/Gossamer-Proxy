<?php


namespace core\system;

use Monolog\Logger;
use exceptions\RedirectKeyNotFoundException;
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
    
    public function __construct(Logger &$logger = null, HTTPRequest &$httpRequest) {
        $this->logger = $logger;
        $this->httpRequest = $httpRequest;
    }
    
    public function redirect($ymlkey, array $params = null) {
       
        $ymlURI = $this->getURLByYamlKey($ymlkey);
        
        if(is_null($ymlURI)) {
            throw new RedirectKeyNotFoundException('Router redirect key not found');
        }
        $redirectUrl =   $this->parseRequestUriParameters($this->httpRequest->getAttribute('HTTP_REFERER'), $ymlURI, $params);
        
        if(!is_null($this->logger->addDebug('redirecting to ' . $redirectUrl)));
        /* Redirect browser */
        header("Location: /$redirectUrl");
        /* Make sure that code below does not get executed when we redirect. */
        exit;
    }
    
    private function getURLByYamlKey($ymlkey) {
        $loader = new YAMLKeyParser($this->logger);
        echo $ymlkey;
        $node = $loader->getNodeByKey($ymlkey, 'routing');
pr($node);
        if(!is_null($node) && count($node) > 0) {
            return $node['pattern'];
        }
    }
   
    private function parseRequestUriParameters($uri, $ymlURI, array $params = null) {        
        $uriList = explode('/', $uri);
        $rawUriList = explode('/', $ymlURI);
        if(is_null($params)) {
            //let's assume the programmer is wanting to re-use the hold params.
            // redirecting to the previous page perhaps?
            return implode('/', array_slice($uriList, -(count($rawUriList))));
        }
        //we have params - let's rebuild the uri with the passed params
       
        $rawList = '';
        foreach($rawUriList as $chunk) {
            if($chunk == '*') {
                //pop the first element off the array
                $rawList .= '/' . array_shift($params); 
            } else {
                $rawList .= '/' . $chunk;
            }
        }
      
        return substr($rawList, 1);
    }

        
    
}
