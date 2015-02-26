<?php

namespace core\components\security\handlers;


use core\services\ServiceInterface;
use core\datasources\DatasourceAware;
use Monolog\Logger;
use libraries\utils\Container;
use libraries\utils\YAMLParser;
use libraries\utils\URISectionComparator;

/**
 * Description of AuthorizationHandler
 *
 * @author davem
 */
class AuthorizationHandler extends DatasourceAware implements ServiceInterface{
    
    protected $container = null;
    
    protected $provider = null;
            
    public function __construct(Logger $logger) {
        $this->logger = $logger;        
    }
    
    public function execute() {
        //$this->provider->setClient()
    }

    public function setContainer(Container $container) {
        $this->container = $container;
    }

    public function setParameters(array $params) {
        $this->provider = $params['provider'];                
    }

}
