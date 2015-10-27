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
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;
use libraries\utils\Container;

/**
 * handles all events that are raised
 *
 * @author Dave Meikle
 */
class EventHandler {

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
    private $eventDispatcher = null;

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
    }

    /**
     * accessor
     *
     * @param type $datasourceKey
     */
    public function setDatasourceKey($datasourceKey) {
        $this->datasourceKey = $datasourceKey;
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
     * @param Container $container
     */
    public function setContainer(Container &$container) {
        $this->container = $container;
    }

    /**
     * accessor
     *
     * @param HTTPRequest $httpRequest
     */
    public function setHttpRequest(HTTPRequest $httpRequest) {
        $this->httpRequest = $httpRequest;
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
     * @param HTTPResponse $httpResponse
     */
    public function setHttpResponse(HTTPResponse $httpResponse) {
        $this->httpResponse = $httpResponse;
    }

    /**
     * accessor
     *
     * @param type $listener
     */
    public function addListener($listener) {
        $this->listeners[] = $listener;
        if (array_key_exists('listener', $listener)) {
            $this->logger->addDebug($listener['listener'] . ' added to listeners');
        }
    }

    /**
     * traverses list of listeners and executes their calls
     */
    public function notifyListeners() {

        $this->logger->addDebug('*** notifying listeners ***');
        foreach ($this->listeners as $listener) {

            $listenerClass = $listener['listener'];
            $handler = array($listenerClass, 'on_' . $this->state);
            if ($this->state == $listener['event'] && is_callable($handler)) {
                unset($listener['listener']);

                $eventListener = new $listenerClass($this->logger, $this->httpRequest, $this->httpResponse);
                $eventListener->setDatasources($this->datasourceFactory, $this->datasources);
                $eventListener->setDatasourceKey($this->datasourceKey);
                $eventListener->setEventDispatcher($this->eventDispatcher);
                $eventListener->setConfig($listener);
                // echo "execute " . get_class($eventListener) . "\r\n";
                $eventListener->execute($this->state, $this->params);
            } else {
                $this->logger->addError($listenerClass . ' not found by EventHandler::notifyListeners');
                // echo "unable call $listenerClass " . $this->state ."\r\n";
            }
        }
    }

    /**
     * accessor
     *
     * @param string $state
     * @param string $params
     */
    public function setState($state, &$params) {
        $this->state = $state;
        $this->params = $params;

        $this->notifyListeners();
    }

}
