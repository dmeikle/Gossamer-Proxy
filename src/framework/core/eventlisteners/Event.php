<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\eventlisteners;

class Event
{
    private $eventName = null;
    
    private $params = null;
    
    
    public function __construct($eventName = '', &$params = array()) {
        $this->eventName = $eventName;
        $this->params = $params;
    }
    
    public function getEventName() {
        return $this->eventName;
    }
    
    public function getParams() {
        return $this->params;
    }
    
    public function setParams($params) {
        $this->params = $params;
    }
}
