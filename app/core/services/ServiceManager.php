<?php

namespace core\services;

use libraries\utils\YAMLParser;
use core\services\ServiceInterface;
use Monolog\Logger;
use core\datasources\DatasourceAware;
use core\datasources\DatasourceFactory;
use libraries\utils\Container;

/**
 * Description of ServiceManager
 *
 * @author Dave Meikle
 */
class ServiceManager {
    
    private $serviceConfig = null;
    
    private $services = null;
    
    private $logger = null;
    
    private $datasourceFactory = null;
    
    private $container = null;
    
    public function __construct(Logger $logger, array $serviceConfig, DatasourceFactory $datasourceFactory, Container $container) {
        $this->container = $container;
        $this->formatArray($serviceConfig);
        $this->services = array();
        $this->logger = $logger;
        $this->datasourceFactory = $datasourceFactory;
    }
    
    private function formatArray(array $config) {
        foreach($config as $serviceList) {
            foreach ($serviceList as $key => $item) {
                $this->serviceConfig[$key] = $item;
            }
        }
    }
    
    private function assembleService(array $config) {
        $arguments = array();
        if(array_key_exists('arguments', $config)) {
            $arguments = $config['arguments'];
        }
        $injectors = array();
        //load any constructor parameters
        foreach($arguments as $argument) {
            if(substr($argument, 0, 1) == '@') {
                $key = substr($argument, 1);
                //it's another service - looks like we're starting a loop here...
                $injectors[$key] = $this->getService($key);//strip the '@' and ask for it by its name/key provided
            } else {
                echo "creating new $argument<br>";
                //load it like a class file - hopefully the author didn't expect any constructor params...
                $injectors[$argument] = new $argument();
            }
        }
        $className = $config['handler'];
        $class = new $className($this->logger);
        
        if($class instanceof ServiceInterface) {          
            $class->setContainer($this->container);
            $class->setParameters($injectors);
           
        }
        
        if(array_key_exists('datasource', $config)) {
            if($class instanceof DatasourceAware) {
                $class->setDatasource($this->datasourceFactory->getDatasource($config['datasource'], $this->logger));
            }
        }
        
        return $class;
    }
    
    /**
     * getService - a lazy loader that will only create a service if asked for...
     *              no sense creating a bunch of services in config if the requested
     *              url doesn't require them
     * @param string $key - the key in the services.yml file
     * @return service
     */
    public function getService($key) {
        if(!array_key_exists($key, $this->services)) {
            $this->services[$key] = $this->assembleService($this->serviceConfig[$key]);
        }
        
        return $this->services[$key];        
    }
    
    public function executeService($key) {
        $this->getService($key)->execute();
    }
}
