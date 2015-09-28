<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\staff\listeners;

use core\eventlisteners\AbstractListener;
use libraries\utils\YAMLConfiguration;

/**
 * GetYMLKeyByUrlListener
 *
 * @author Dave Meikle
 */
class GetYMLKeyByUrlListener extends AbstractListener {
    
    public function on_request_start($params) {
        $parser = new YAMLConfiguration($this->logger);
     
        $node = $parser->getNodeParameters($this->getRequestUri());
        
        $this->httpRequest->setAttribute('urlYmlKey', $node['ymlKey']);
    }
    
    private function getRequestUri() {
        $fullUrl = $this->httpRequest->getAttribute('HTTP_REFERER');
        
        $fullUrl = str_replace('http://', '', $fullUrl);
        $fullUrl = str_replace('https//', '', $fullUrl);
        
        $pieces = explode('/', $fullUrl);
        //lose the domain name
        array_shift($pieces);
        
        return implode('/', $pieces);
                
    }
}
