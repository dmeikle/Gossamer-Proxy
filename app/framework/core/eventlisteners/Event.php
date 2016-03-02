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

/**
 * a container for values to be passed in when dispatching an event
 */
class Event {

    private $eventName = null;
    private $params = null;

    /**
     * 
     * @param type $eventName
     * 
     * @param type $params
     */
    public function __construct($eventName = '', &$params = array()) {
        $this->eventName = $eventName;
        $this->params = $params;
    }

    /**
     * accessor 
     * 
     * @return string
     */
    public function getEventName() {
        return $this->eventName;
    }

    /**
     * accessor
     * 
     * @return string
     */
    public function getParams() {
        return $this->params;
    }

    /**
     * accessor
     * 
     * @param mixed $params
     */
    public function setParams($params) {
        $this->params = $params;
    }

}
