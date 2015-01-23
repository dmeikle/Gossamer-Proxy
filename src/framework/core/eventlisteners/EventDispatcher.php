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

use core\datasources\DatasourceFactory;
use core\eventlisteners\EventHandler;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;
use libraries\utils\Container;


class EventDispatcher{
    
    private $listeners = array();
 
    private $logger = null;

    private $httpRequest = null;

    private $httpResponse = null;

    private $datasourceFactory = null;

    private $datasources = null;


    public function __construct($config = array(), Logger $logger, HTTPRequest $httpRequest, HTTPResponse $httpResponse) {
        if(!is_null($config)) {
            $config = array_filter($config);
        }
       
        $this->httpRequest = $httpRequest;
        $this->httpResponse = $httpResponse;
        $this->logger = $logger;
        $this->logger->addInfo('EventDispatcher started');
        
        if(count($config) > 0) {
            $this->configListeners($config);
        }
    }

    public function setDatasources(DatasourceFactory $factory, array $datasources) {
        $this->datasourceFactory = $factory;
        $this->datasources = $datasources;
    }
    public function setHttpRequest(HTTPRequest $httpRequest) {
        $this->httpRequest = $httpRequest;
    }

    public function setHttpResponse(HTTPResponse $response) {
        $this->httpResponse = $response;
    }

    public function setLogger($logger) {
        $this->logger = $logger;
    }
    
    public function configListeners(array $listeners) {


        foreach($listeners as $uri => $listener) {          
            if(!is_array($listener)) {
                continue;
            }
            if(array_key_exists('listeners', $listener)  && count($listener['listeners']) > 0) {
                try{
                    $this->logger->addDebug('EventDispatcher::configListeners adding eventhandler for ' . $uri);
                    $this->addEventHandler( $uri, $listener['listeners']);   
                }catch(\Exception $e) {
                    //assume the developer has an empty element such as:
                    //listeners:
                    //with no sub elements, which is allowable
                    $this->logger->addError('EventDispatcher::configListeners threw exception adding eventhandler for ' . $uri);
                    $this->logger->addError($e->getMessage());                    
                }
                
            }
        }
    }
    
    private function addEventHandler($uri, array $listeners) {
        
        foreach($listeners as $listener) {
            if(array_key_exists('methods', $listener)) {
                if(!in_array(__REQUEST_METHOD, $listener['methods'])) {
                    continue;
                }
            }
            
            $handler = new EventHandler($this->logger, $this->httpRequest, $this->httpResponse);
            $handler->setDatasources($this->datasourceFactory, $this->datasources);
            $handler->setEventDispatcher($this);
            $handler->addListener($listener);  
            
            if(array_key_exists('datasource', $listener)) {
                //manual override - useful for loading info from other models
                $handler->setDatasourceKey($listener['datasource']);
            }
            
            $this->logger->addDebug('listener added for '. $listener['listener']);          
            $this->listen($uri, $handler);
        } 
           
    }
    
    public function listen($uri, EventHandler $handler) {
        $this->logger->addDebug('adding eventhandler for ' . $uri . ' to listeners list');
       
        $this->listeners[$uri][] = $handler;
    }
 
    public function dispatch($uri, $state, Event &$params = null) {
        //error_log("dispatch called for $uri with state set to $state");
       $this->logger->addDebug("dispatch called for $uri with state set to $state");
       $keys = array_keys($this->listeners);
        if(!array_key_exists($uri, $this->listeners)) {
            
            $this->logger->addDebug("no listeners found for $uri with state set to $state");            
            return;
        }        
        $this->logger->addDebug("listeners found - iterating");
       
        foreach ($this->listeners[$uri] as $listener)
        {
           // error_log('dispatching ' . $state . ' on ' . get_class($listener) . ' listener class for uri: ' . $uri);
            $this->logger->addDebug('dispatching ' . $state . ' on ' . get_class($listener) . ' listener class for uri: ' . $uri);
            $listener->setState($state, $params);
          // echo $state . ' listener class for uri: ' . $uri.'<br>';
        }
        
    }
    
    public function getListenerURIs() {
        return array_keys($this->listeners);
    }
}
