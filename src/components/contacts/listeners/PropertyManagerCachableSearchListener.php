<?php

namespace components\contacts\listeners;

use core\eventlisteners\CachableSearchListener;


/**
 * Description of ContactsCachableSearchListener
 *
 * @author davem
 */
class PropertyManagerCachableSearchListener extends CachableSearchListener{
    
    public function __construct(\Monolog\Logger $logger, \core\http\HTTPRequest $httpRequest, \core\http\HTTPResponse $httpResponse) {
        parent::__construct($logger, $httpRequest, $httpResponse);
        $this->verb = 'searchPropertyManagers';
    }

}
