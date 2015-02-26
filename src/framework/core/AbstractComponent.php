<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core;

use exceptions\ParameterNotPassedException;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use libraries\utils\Registry;
use Monolog\Logger;
use libraries\utils\Container;
use exceptions\HandlerNotCallableException;
use core\eventlisteners\Event;

/**
 * 
 * class AbstractComponent -    this is the base class for the drop in components used to
 *                              preload any listeners for the selected component as well as
 *                              any pre-config.
 * 
 * @author Dave Meikle
 * 
 * @Copyright: Quantum Unit Solutions 2014
 */
abstract class AbstractComponent {

    private $controllerName = null;
    private $modelName = null;
    private $method = null;
    private $params = null;
    private $logger = null;
    private $viewName;
    private $container = null;
    private $agentType;

    /**
     * 
     * @param string $controllerName
     * @param string $viewName
     * @param string $modelName
     * @param string $method
     * @param array $params
     * @param Logger $logger
     * @param array $agentType
     * 
     * @throws ParameterNotPassedException
     */
    public function __construct($controllerName, $viewName, $modelName, $method = null, array $params = null, Logger $logger, array $agentType) {
        //$this->logger->addDebug("abstractComponent: command:$command  entity:$entity" );

        if (is_null($controllerName)) {
            throw new ParameterNotPassedException('controller name is null');
        } else if (is_null($modelName)) {
            throw new ParameterNotPassedException('model is null');
        }
        $this->controllerName = $controllerName;

        $this->viewName = $viewName;

        $this->modelName = $modelName;

        $this->method = $method;

        $this->params = $params;

        $this->logger = $logger;

        $this->agentType = $agentType;
    }

    /**
     * accessor
     * 
     * @param Container $container
     */
    public function setContainer(Container $container) {
        $this->container = $container;
    }

    /**
     * handleRequest - entry point for the class
     * 
     * @param Request   the filtered request object
     * @param Registry  the registry object
     * 
     */
    public function handleRequest(HTTPRequest &$httpRequest, HTTPResponse &$httpResponse) {
        // echo __YML_KEY;
        $handler = array(
            $this->controllerName,
            $this->method
        );

        if (is_callable($handler)) {

            //$commandName = $this->command;
            $model = new $this->modelName($httpRequest, $httpResponse, $this->logger);
            $static = $httpRequest->getAttribute($this->modelName . '_static');
            if (!is_null($static) && strlen($static) > 0) {
              
                echo $static;
                $this->container->get('EventDispatcher')->dispatch('all', system\KernelEvents::RENDER_BYPASS, new Event());
                $this->container->get('EventDispatcher')->dispatch(__YML_KEY, system\KernelEvents::RENDER_BYPASS, new Event());

                return;
            }
            $model->setContainer($this->container);

            $model->setDatasource($this->getDatasource());

            $view = new $this->viewName($this->logger, __YML_KEY, $this->agentType, $httpRequest, $httpResponse);

            $view->setContainer($this->container);

            $controller = new $this->controllerName($model, $view, $this->logger, $httpRequest, $this->logger);

            $controller->setContainer($this->container);
            try {

                return call_user_func_array(array(
                    $controller,
                    $this->method
                        ), !isset($this->params) ? array() : $this->params);
            } catch (\Exception $e) {
                //die($e->getMessage());
                //TODO: this currently is only for the template view
                //$view = new TemplateExceptionView($this->logger, __YML_KEY, $this->agentType, $httpRequest, $e);
                $view = new $this->viewName($this->logger, 'exception', $this->agentType, $httpRequest);
                $view->setContainer($this->container);
                $view->setYmlKey('exception');
                $controller->setView($view);

                return $controller->render(array());
            }
        } else {
            pr($handler);
            throw new HandlerNotCallableException('unable to match method ' . $this->method . ' to controller');
        }
    }

    /**
     * 
     * @return datasource
     */
    private function getDatasource() {
        $factory = $this->container->get('datasourceFactory');

        $sources = $this->container->get('datasources');
        $datasource = $factory->getDatasource($sources[$this->modelName], $this->logger);
        $datasource->setDatasourceKey($sources[$this->modelName]);

        return $datasource;
    }

    /** the __NAMESPACE__ is determined at compile time so we need to place this in the child:
     * return str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
     */
    protected abstract function getChildNamespace();
}
