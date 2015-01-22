<?php

namespace libraries\utils\routing;

use core\http\HTTPRequest;
use libraries\utils\URIComparator;

/**
 * Description of DefaultRouting
 *
 * @author davem
 */
class DefaultRouting {
   
    private $httpRequest = null;
    
    public function __construct(HTTPRequest $httpRequest) {
        $this->httpRequest = $httpRequest;
    }
    
    public function getDefaultRoutingKey(array $config) {
        $pieces = $this->getUriPieces();
        
        return $this->findMatchingPattern($config, $pieces);        
    }
    
    private function findMatchingPattern(array $config, array $pieces) {
        $comparator = new URIComparator();
        
        return $comparator->findPattern($config, $this->httpRequest->getUri());        
    }
    
    private function getUriPieces() {
        $uri = $this->httpRequest->getUri();
        
        return explode('/', $uri);
    }
}
