<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\system;

use core\http\HTTPRequest;
use core\eventlisteners\Event;
use core\system\KernelEvents;
use libraries\utils\Container;
use Monolog\Logger;
use libraries\utils\MobileDetect;

/**
 * the core of the Framework. Called to execute the program once the bootstrap
 * processes have completed.
 * 
 * @author Dave Meikle
 */
class Kernel {

    private $container = null;
    private $logger = null;

    public function __construct(Container $container, Logger $logger) {
        $this->container = $container;
        $this->logger = $logger;
    }

    /**
     * main entry point for this class
     * 
     * @return string|JSON - the completed html or json array
     */
    public function run() {

        $controllerNode = $this->container->get('controllerNode');

        $httpRequest = $this->container->get('HTTPRequest');
        $httpResponse = $this->container->get('HTTPResponse');

        $componentName = $controllerNode['component'];
        $controllerName = $controllerNode['controller'];
        $modelName = $controllerNode['model'];
        $viewName = $controllerNode['view'];
        $method = $controllerNode['method'];

        $this->configSessionParamsToRequest($httpRequest);

        //EventDispatcher is created in bootstrap
        //first, run any security checks before starting the request
        $event = new Event(KernelEvents::ENTRY_POINT, $httpRequest);

        $this->container->get('EventDispatcher')->dispatch('all', KernelEvents::REQUEST_START);

        //still here? ok, now start the request
        $event = new Event(KernelEvents::REQUEST_START, $httpRequest);
        $this->container->get('EventDispatcher')->dispatch(__YML_KEY, KernelEvents::REQUEST_START);

        $this->logger->addDebug('dispatcher started in index - state set to ' . KernelEvents::REQUEST_START);

        $cmd = new $componentName($controllerName, $viewName, $modelName, $method, $httpRequest->getParameters(), $this->logger, $this->getLayoutType());
        $cmd->setContainer($this->container);

        return $cmd->handleRequest($httpRequest, $httpResponse);
    }

    /**
     * determines if we are dealing with a computer or mobile device
     * 
     * @return array
     */
    private function getLayoutType() {
        $detector = new MobileDetect();
        $isMobile = $detector->isMobile();
        $isTablet = $detector->isTablet();
        unset($detector);

        return array('isMobile' => $isMobile, 'isTablet' => $isTablet);
    }

    /**
     * creates any session params in the event we are reloading the page so
     * the params are available for access after the redirect.
     * 
     * @param HTTPRequest $request
     */
    private function configSessionParamsToRequest(HTTPRequest &$request) {
        $request->setAttribute('ERROR_RESULT', getSession('ERROR_RESULT'));
        $request->setAttribute('POSTED_PARAMS', getSession('POSTED_PARAMS'));
       
        setSession('ERROR_RESULT', null);
        setSession('POSTED_PARAMS', null);
    }

}
