<?php

namespace core\eventlisteners;

use core\datasources\DatasourceFactory;
use core\http\HTTPResponse;
use Monolog\Logger;
use core\http\HTTPRequest;
use libraries\utils\Container;


class AbstractListener
{
    protected $logger = null;
    
    protected $httpRequest = null;

    protected $httpResponse = null;

    protected  $datasourceFactory = null;

    protected  $datasources = null;

    public function __construct(Logger $logger, HTTPRequest $httpRequest, HTTPResponse $httpResponse) {
        $this->logger = $logger;
        $this->httpRequest = $httpRequest;
        $this->httpResponse = $httpResponse;
    }


    public function setDatasources(DatasourceFactory $factory, array $datasources) {
        $this->datasourceFactory = $factory;
        $this->datasources = $datasources;
    }

    protected function getDatasource($modelName) {

        $datasource = $this->datasourceFactory->getDatasource($this->datasources[$modelName], $this->logger);
        $datasource->setDatasourceKey($this->datasources[$modelName]);

        return $datasource;
    }

    public function execute($state, $params) {

        $method = 'on_' . $state;
        $this->logger->addDebug('checking listener for method: ' . $method);
         if (method_exists($this, $method)) {
            call_user_func_array(array($this, $method), array($params));        
        }
    }
}
