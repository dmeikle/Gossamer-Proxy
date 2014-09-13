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
    
    protected $datasourceKey = null;
    
    protected $container = null;

    public function __construct(Logger $logger, HTTPRequest $httpRequest, HTTPResponse $httpResponse) {
        $this->logger = $logger;
        $this->httpRequest = $httpRequest;
        $this->httpResponse = $httpResponse;
    }

    public function setDatasourceKey($datasourceKey) {
        $this->datasourceKey = $datasourceKey;
    }
    
    public function setContainer(Container $container) {
        $this->container = $container;
    }
    public function setDatasources(DatasourceFactory $factory, array $datasources) {
        $this->datasourceFactory = $factory;
        $this->datasources = $datasources;
    }

    protected function getDatasource($modelName) {
      
        if(!is_null($this->datasourceKey)) {
            $datasource = $this->datasourceFactory->getDatasource($this->datasourceKey, $this->logger);
            $datasource->setDatasourceKey($this->datasourceKey);
        }else{
            $datasource = $this->datasourceFactory->getDatasource($this->datasources[$modelName], $this->logger);
            $datasource->setDatasourceKey($this->datasources[$modelName]);
        }
        
        

        return $datasource;
    }

    public function execute($state, $params) {

        $method = 'on_' . $state;
        $this->logger->addDebug('checking listener for method: ' . $method);
         if (method_exists($this, $method)) {
            $this->logger->addDebug('class: ' . get_class($this) . ' found');
            call_user_func_array(array($this, $method), array($params));        
        }
    }
    
    
    protected function getDefaultLocale() {        
        $userPreferences = getSession('userPreferences');
        if(!is_null($userPreferences) && array_key_exists('defaultLocale', $userPreferences)) {
            return $userPreferences['defaultLocale'];
        }

        $config = $this->httpRequest->getAttribute('defaultPreferences');

        return $config['default_locale'];
    }
}
