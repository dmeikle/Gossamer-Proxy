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
use core\http\HTTPResponse;
use Monolog\Logger;
use core\http\HTTPRequest;
use libraries\utils\Container;
use libraries\utils\preferences\UserPreferences;
use libraries\utils\preferences\UserPreferencesManager;

/**
 * base class for all Event Listeners - abstracts a lot of the framework
 * stuff away from the developers
 * 
 * @author Dave Meikle
 */
class AbstractListener {

    protected $logger = null;
    protected $httpRequest = null;
    protected $httpResponse = null;
    protected $datasourceFactory = null;
    protected $datasources = null;
    protected $datasourceKey = null;
    protected $container = null;
    protected $listenerConfig = null;
    protected $eventDispatcher = null;

    /**
     * 
     * @param Logger $logger
     * @param HTTPRequest $httpRequest
     * @param HTTPResponse $httpResponse
     */
    public function __construct(Logger $logger, HTTPRequest &$httpRequest, HTTPResponse &$httpResponse) {
        $this->logger = $logger;
        $this->httpRequest = $httpRequest;
        $this->httpResponse = $httpResponse;
        // echo get_called_class().'<br>';
        
    }

    /**
     * accessor 
     * @param string $datasourceKey
     */
    public function setDatasourceKey($datasourceKey) {
        $this->datasourceKey = $datasourceKey;
    }

    /**
     * accessor
     * 
     * @param Container $container
     */
    public function setContainer(Container &$container) {

        $this->container = $container;
    }

    /**
     * accessor
     * 
     * @param \core\eventlisteners\EventDispatcher $eventDispatcher
     */
    public function setEventDispatcher(EventDispatcher &$eventDispatcher) {
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * accessor
     * 
     * @param DatasourceFactory $factory
     * @param array $datasources
     */
    public function setDatasources(DatasourceFactory $factory, array $datasources) {
        $this->datasourceFactory = $factory;
        $this->datasources = $datasources;
    }

    /**
     * accessor
     * 
     * @param type $modelName
     * 
     * @return datasource
     */
    protected function getDatasource($modelName) {

        if (!is_null($this->datasourceKey)) {

            $datasource = $this->datasourceFactory->getDatasource($this->datasourceKey, $this->logger);
            $datasource->setDatasourceKey($this->datasourceKey);
        } else {
            if(!array_key_exists($modelName, $this->datasources)) {
                throw new \Exception('datasource key missing from listeners configuration');
            }
            $datasource = $this->datasourceFactory->getDatasource($this->datasources[$modelName], $this->logger);
            $datasource->setDatasourceKey($this->datasources[$modelName]);
        }

        return $datasource;
    }

    /**
     * entry point. determines which on_ method to call based on configuration
     * and state.  
     * 
     * @param type $state - the occurrence - eg: request_start
     *                  method will call the on_request_start in the child class
     * 
     * @param type $params - any values needed
     */
    public function execute($state, &$params) {

        $method = 'on_' . $state;

        $this->logger->addDebug('checking listener for method: ' . $method);

        if (method_exists($this, $method)) {       
            $this->logger->addDebug('class: ' . get_class($this) . ' found');
            call_user_func_array(array($this, $method), array($params));
        }
    }

    /**
     * 
     * @return Locale
     */
    protected function getDefaultLocale() {
        //check to see if it's in the query string - a menu request perhaps?
        $queryLocale = $this->httpRequest->getQueryParameter('locale');
        if(!is_null($queryLocale)) {
            return array('locale' =>$queryLocale);
        }
        
        $manager = new UserPreferencesManager($this->httpRequest);
        $userPreferences = $manager->getPreferences();

        if (!is_null($userPreferences) && $userPreferences instanceof UserPreferences) {
            return array('locale' => $userPreferences->getDefaultLocale());
        }

        $config = $this->httpRequest->getAttribute('defaultPreferences');

        return $config['default_locale'];
    }

    
    /**
     * accessor
     * 
     * @param array $listenerConfig
     */
    public function setConfig(array $listenerConfig) {
        $this->listenerConfig = $listenerConfig;
    }

    /**
     * accessor
     * 
     * @return SecurityToken
     */
    protected function getSecurityToken() {
        $serializedToken = getSession('_security_secured_area');
        $token = unserialize($serializedToken);

        return $token;
    }

    /**
     * 
     * @return int - the id of the logged in user
     */
    protected function getLoggedInStaffId() {
        $token = $this->getSecurityToken();

        return $token->getClient()->getId();
    }

}
