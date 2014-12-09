<?php

namespace core\eventlisteners;

class Event
{
    private $eventName = null;
    
    private $params = null;
    
    
    public function __construct($eventName, &$params) {
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
