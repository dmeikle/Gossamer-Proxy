<?php


namespace core\eventlisteners;

use core\datasources\DatasourceFactory;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;
use libraries\utils\Container;

class EventHandler
{
    private $listeners = array();
    
    private $state = null;
    
    private $params = null;
    
    private $logger = null;

    private $container = null;

    private $httpRequest = null;

    private $httpResponse = null;

    private $datasourceFactory = null;

    private $datasources = null;

    private $datasourceKey = null;
    
    public function __construct(Logger $logger,HTTPRequest $httpRequest,HTTPResponse $httpResponse ) {
        $this->logger = $logger;
        $this->httpRequest = $httpRequest;
        $this->httpResponse = $httpResponse;
    }


    public function setDatasourceKey($datasourceKey) {
        $this->datasourceKey = $datasourceKey;
    }
    
    public function setDatasources(DatasourceFactory $factory, array $datasources) {
        $this->datasourceFactory = $factory;
        $this->datasources = $datasources;
    }

    public function setContainer(Container $container) {
        $this->container = $container;
    }
    
    public function setHttpRequest(HTTPRequest $httpRequest) {
        $this->httpRequest = $httpRequest;
    }
    public function setHttpResponse(HTTPResponse $httpResponse) {
        $this->httpResponse = $httpResponse;
    }


    public function addListener($listener) {
        $this->listeners[] = $listener;
        $this->logger->addDebug($listener . ' added to listeners');
    }


    public function notifyListeners() {
        $this->logger->addDebug('notifying listeners');
        foreach($this->listeners as $listener) {
            $eventListener = new $listener($this->logger, $this->httpRequest, $this->httpResponse);
            $eventListener->setDatasources($this->datasourceFactory, $this->datasources);
            $eventListener->setDatasourceKey($this->datasourceKey);
            $eventListener->execute($this->state, $this->params);
        }
    }

    
    public function setState($state, $params) {
        $this->state = $state;
        $this->params = $params;
        
        $this->notifyListeners();
    }
    
}
