<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\services;

use core\services\traits\MultipleDatasourcesTrait;
use libraries\utils\YAMLParser;
use core\services\ServiceInterface;
use Monolog\Logger;
use core\datasources\DatasourceAware;
use core\datasources\DatasourceFactory;
use libraries\utils\Container;
use core\components\security\providers\HttpAwareInterface;
use core\datasources\DataSourceInterface;

/**
 * loads all bootstrap services
 *
 * @author Dave Meikle
 */
class ServiceManager {

    private $serviceConfig = null;
    private $services = null;
    private $logger = null;
    private $datasourceFactory = null;
    private $container = null;

    /**
     * 
     * @param Logger $logger
     * @param array $serviceConfig
     * @param DatasourceFactory $datasourceFactory
     * @param Container $container
     */
    public function __construct(Logger $logger, array $serviceConfig, DatasourceFactory $datasourceFactory, Container $container) {
        $this->container = $container;
        $this->formatArray($serviceConfig);
        $this->services = array();
        $this->logger = $logger;
        $this->datasourceFactory = $datasourceFactory;
    }

    /**
     * 
     * @param array $config
     */
    private function formatArray(array $config) {
        foreach ($config as $serviceList) {
            foreach ($serviceList as $key => $item) {
                $this->serviceConfig[$key] = $item;
            }
        }
    }

    /**
     * creates all services
     * 
     * @param array $config
     * 
     * @return HttpAwareInterface
     */
    private function assembleService(array $config) {
        $arguments = array();
        if (array_key_exists('arguments', $config)) {
            $arguments = $config['arguments'];
        }
        $injectors = array();

        //load any  constructor parameters
        foreach ($arguments as $key => $argument) {
            if (substr($argument, 0, 1) == '@') {
                $argument = substr($argument, 1);
                //it's another service - looks like we're starting a loop here...
                if ($key == '0') {
                    $injectors[$argument] = $this->getService($argument); //strip the '@' and ask for it by its name/key provided
                } else {
                    $injectors[$key] = $this->getService($argument); //strip the '@' and ask for it by its name/key provided
                }
            } else {
                //load it like a class file - hopefully the author didn't expect any constructor params...
                $injectors[$key] = new $argument();
            }
        }
        $className = $config['handler'];
        $class = new $className($this->logger);

        if ($class instanceof ServiceInterface) {
            $class->setContainer($this->container);
            $class->setParameters($injectors);
        }

        if (array_key_exists('datasource', $config)) {
            if ($class instanceof DatasourceAware) {
                $conn = $this->datasourceFactory->getDatasource($config['datasource'], $this->logger);

                $class->setDatasource($conn);
            }
        }
        $usedTraits = class_uses($class);

        if(array_key_exists('core\services\traits\MultipleDatasourcesTrait', $usedTraits)) {
            $class->setDatasourceFactory($this->datasourceFactory);
        }

        if ($class instanceof HttpAwareInterface) {

            $class->setHttpRequest($this->container->get('HTTPRequest'));
            $class->setHttpResponse($this->container->get('HTTPResponse'));
            $class->setLogger($this->logger);
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
        if (is_null($key)) {
            return;
        }
        if (!array_key_exists($key, $this->services)) {
            $this->services[$key] = $this->assembleService($this->serviceConfig[$key]);
        }

        return $this->services[$key];
    }

    /**
     * calls the execute() method of a service requested
     * 
     * @param string $key
     * 
     * @return mixed
     */
    public function executeService($key) {

        $service = $this->getService($key);
        if (is_null($service)) {
            return;
        }
        try {
         
            $this->getService($key)->execute();
        } catch (\Exception $e) {
            die('here');
        }
    }

}
