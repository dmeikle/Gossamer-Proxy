<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\contacts\listeners;

use core\eventlisteners\CachableSearchListener;


/**
 * Description of ContactsCachableSearchListener
 *
 * @author Dave Meikle
 */
class PropertyManagerCachableSearchListener extends CachableSearchListener{
    
    public function __construct(\Monolog\Logger $logger, \core\http\HTTPRequest $httpRequest, \core\http\HTTPResponse $httpResponse) {
        parent::__construct($logger, $httpRequest, $httpResponse);
        $this->verb = 'searchPropertyManagers';
    }

}
