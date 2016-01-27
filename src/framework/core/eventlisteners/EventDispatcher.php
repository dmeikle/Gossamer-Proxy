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

/**
 * loads and dispatches all listeners when events are raised
 *
 * @author Dave Meikle
 */
class EventDispatcher {

    private $listeners = array();
    private $logger = null;
    private $httpRequest = null;
    private $httpResponse = null;
    private $datasourceFactory = null;
    private $datasources = null;

    /**
     *
     * @param type $config
     * @param Logger $logger
     * @param HTTPRequest $httpRequest
     * @param HTTPResponse $httpResponse
     */
    public function __construct($config = array(), Logger $logger, HTTPRequest &$httpRequest, HTTPResponse &$httpResponse) {
        if (!is_null($config)) {
            $config = array_filter($config);
        }

        $this->httpRequest = $httpRequest;
        $this->httpResponse = $httpResponse;
        $this->logger = $logger;
        $this->logger->addInfo('EventDispatcher started');

        if (count($config) > 0) {
            $this->configListeners($config);
        }
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
     * @param HTTPRequest $httpRequest
     */
    public function setHttpRequest(HTTPRequest &$httpRequest) {
        $this->httpRequest = $httpRequest;
    }

    /**
     * accessor
     *
     * @param HTTPResponse $response
     */
    public function setHttpResponse(HTTPResponse &$response) {
        $this->httpResponse = $response;
    }

    /**
     * accessor
     *
     * @param Logger $logger
     */
    public function setLogger($logger) {
        $this->logger = $logger;
    }

    /**
     * configures event listeners
     *
     * @param array $listeners
     */
    public function configListeners(array $listeners) {

        foreach ($listeners as $uri => $listener) {
            if (!is_array($listener)) {
                continue;
            }
            if (array_key_exists('listeners', $listener) && count($listener['listeners']) > 0) {
                try {
                    $this->logger->addDebug('EventDispatcher::configListeners adding eventhandler for ' . $uri);
                    $this->addEventHandler($uri, $listener['listeners']);
                } catch (\Exception $e) {
                    //assume the developer has an empty element such as:
                    //listeners:
                    //with no sub elements, which is allowable
                    $this->logger->addError('EventDispatcher::configListeners threw exception adding eventhandler for ' . $uri);
                    $this->logger->addError($e->getMessage());
                }
            }
        }
    }

    /**
     * configures event listeners for a local node
     * CP-175
     * @param array $listeners
     */
    public function configNodeListeners($uri, array $listeners) {

        if (array_key_exists('listeners', $listeners) && count($listeners['listeners']) > 0) {
            try {
                $this->logger->addDebug('EventDispatcher::configListeners adding eventhandler for ' . $uri);
                $this->addEventHandler($uri, $listeners['listeners']);
            } catch (\Exception $e) {
                //assume the developer has an empty element such as:
                //listeners:
                //with no sub elements, which is allowable
                $this->logger->addError('EventDispatcher::configListeners threw exception adding eventhandler for ' . $uri);
                $this->logger->addError($e->getMessage());
            }
        }
    }

    /**
     * creates event handlers that are wrappers to event listeners that
     * do the actual work.
     *
     * @param type $uri
     * @param array $listeners
     */
    private function addEventHandler($uri, array $listeners) {

        foreach ($listeners as $listener) {
            if (array_key_exists('methods', $listener)) {
                if (!in_array(__REQUEST_METHOD, $listener['methods'])) {
                    continue;
                }
            }

            /**
             * CP-251 - added ability for multiple datasources since some listeners need to query
             * (for example) the database then send those results to (for example) a proxy
             * service for generating a pdf or an email. This allows the listener to access
             * multiple datasources without making the 'code' aware of which one to ask for.
             */
            if (array_key_exists('datasources', $listener)) {
                foreach ($listener['datasources'] as $datasource) {
                    $this->datasources[$datasource['key']] = $datasource['datasource'];
                }
            }

            $handler = new EventHandler($this->logger, $this->httpRequest, $this->httpResponse);
            $handler->setDatasources($this->datasourceFactory, $this->datasources);
            $handler->setEventDispatcher($this);
            $handler->addListener($listener);

            if (array_key_exists('datasource', $listener)) {
                //manual override - useful for loading info from other models
                $handler->setDatasourceKey($listener['datasource']);
            }
            if (array_key_exists('listener', $listener)) {
                $this->logger->addDebug('listener added for ' . $listener['listener']);
            }
            $this->listen($uri, $handler);
        }
    }

    /**
     * adds an event handler to the listeners list
     *
     * @param type $uri
     * @param EventHandler $handler
     */
    public function listen($uri, EventHandler $handler) {
        //CP-2 added this while working on calling listeners during core/components/render call
        //no need to add handlers that will never match our request
        if ($uri != 'all' && $uri != __YML_KEY) {
            return;
        }
        $this->logger->addDebug('adding eventhandler for ' . $uri . ' to listeners list');

        $this->listeners[$uri][] = $handler;
    }

    /**
     * goes through its listeners list and executes any listeners that are
     * listening for this URI and this STATE
     *
     * @param string $uri
     * @param string $state
     * @param \core\eventlisteners\Event $params
     *
     * @return void
     */
    public function dispatch($uri, $state, Event &$params = null) {

        //error_log("dispatch called for $uri with state set to $state");
        $this->logger->addDebug("dispatch called for $uri with state set to $state");
        $keys = array_keys($this->listeners);
        if (!array_key_exists($uri, $this->listeners)) {

            $this->logger->addDebug("no listeners found for $uri with state set to $state");
            return;
        }
        $this->logger->addDebug("listeners found - iterating");

        foreach ($this->listeners[$uri] as $listener) {
            //echo('dispatching ' . $state . ' on ' . get_class($listener) . ' listener class for uri: ' . $uri."\r\n");
            $this->logger->addDebug('dispatching ' . $state . ' on ' . get_class($listener) . ' listener class for uri: ' . $uri);
            $listener->setState($state, $params);
            //  echo $state . ' listener class for uri: ' . $uri."\r\n";
        }
    }

    /**
     * accessor for getting a list of all loaded listener URIs
     *
     * @return array
     */
    public function getListenerURIs() {
        return array_keys($this->listeners);
    }

}
