<?php

namespace core\system;

use core\http\HTTPRequest;
use core\http\HTTPResponse;
use core\eventlisteners\Event;
use core\system\KernelEvents;
use controllers\ActionsRestController;
use components\users\commands\LoginCommand;
use core\http\ResponseFormatter;
//use libraries\utils\YAMLConfiguration;
use libraries\utils\Container;
use Monolog\Logger;
use core\ViewInterface;
use core\TemplateView;
use core\eventlisteners\EventDispatcher;

use libraries\utils\MobileDetect;

class Kernel
{
    private $container = null;
   
    private $logger = null;
   
    public function __construct(Container $container, Logger $logger) {
        $this->container = $container;
        $this->logger = $logger;
    }
    
    public function run() {
        //$this->container->set('EventDispatcher', null, new EventDispatcher(array(), $this->logger));

        $controllerNode = $this->container->get('controllerNode');

        $httpRequest = $this->container->get('HTTPRequest');
        $httpResponse = $this->container->get('HTTPResponse');
      
        $componentName = $controllerNode['component'];
        $controllerName = $controllerNode['controller'];
        $modelName = $controllerNode['model'];
        $viewName = $controllerNode['view'];
        $method = $controllerNode['method']; 

        //EventDispatcher is created in bootstrap
        //first, run any security checks before starting the request
        $event = new Event(KernelEvents::ENTRY_POINT, $httpRequest);

        $this->container->get('EventDispatcher')->dispatch('all', KernelEvents::REQUEST_START);
        
        //still here? ok, now start the request
        $event = new Event(KernelEvents::REQUEST_START, $httpRequest);
        $this->container->get('EventDispatcher')->dispatch(__YML_KEY, KernelEvents::REQUEST_START);

        $this->logger->addDebug('dispatcher started in index - state set to ' . KernelEvents::REQUEST_START);
        
        $cmd = new $componentName($controllerName, $viewName, $modelName, $method,$httpRequest->getParameters(), $this->logger, $this->getLayoutType());  
        $cmd->setContainer($this->container);

        return $cmd->handleRequest($httpRequest, $httpResponse);
    }

    private function getController(HTTPRequest $httpRequest, HTTPResponse $httpResponse, ViewInterface $view, Logger $logger) {
        
        $controller = 'components\users\controllers\User';
        
        return new $controller($httpRequest, $httpResponse, $view, $logger);
    }

    private function getView() {
        return new TemplateView($this->logger);
    }
    
    private function getLayoutType() {
        $detector = new MobileDetect();
        $isMobile = $detector->isMobile();
        $isTablet = $detector->isTablet();
        unset($detector);
        
        return array('isMobile' => $isMobile, 'isTablet' => $isTablet);
    }
}
