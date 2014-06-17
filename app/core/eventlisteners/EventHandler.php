<?php


namespace core\eventlisteners;

use Monolog\Logger;

class EventHandler
{
    private $listeners = array();
    
    private $state = null;
    
    private $params = null;
    
    private $logger = null;
   
    public function __construct(Logger $logger) {
        $this->logger = $logger;
        
    }
    
    
    public function addListener($listener) {
        $this->listeners[] = $listener;
        $this->logger->addDebug($listener . ' added to listeners');
    }


    public function notifyListeners() {
        $this->logger->addDebug('notifying listeners');
        foreach($this->listeners as $listener) {
            $eventListener = new $listener($this->logger);            
            $eventListener->execute($this->state, $this->params);
        }
    }

    
    public function setState($state, $params) {
        $this->state = $state;
        $this->params = $params;
        
        $this->notifyListeners();
    }
    
}
