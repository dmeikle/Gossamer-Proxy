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
use core\views\AJAXExceptionView;
use Validation\Exceptions\ValidationFailedException;

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

        $handler = array(
            $this->controllerName,
            $this->method
        );

        if (is_callable($handler)) {

            //$commandName = $this->command;
            $model = new $this->modelName($httpRequest, $httpResponse, $this->logger);

            $static = $this->checkStaticCache($httpRequest);
            if (!is_null($static) && strlen($static) > 0) {

                $params = array(
                    'renderedPage' => $static
                );
                $event = new Event(system\KernelEvents::RENDER_BYPASS, $params);

                $this->container->get('EventDispatcher')->dispatch('all', system\KernelEvents::RENDER_BYPASS, $event);
                $this->container->get('EventDispatcher')->dispatch(__YML_KEY, system\KernelEvents::RENDER_BYPASS, $event);
                $params = $event->getParams();
                $static = $params['renderedPage'];

                echo $static;

                return;
            }

            $model->setContainer($this->container);

            $model->setDatasource($this->getDatasource());

            $view = new $this->viewName($this->logger, __YML_KEY, $this->agentType, $httpRequest, $httpResponse);

            $view->setContainer($this->container);

            $controller = new $this->controllerName($model, $view, $this->logger, $httpRequest, $httpResponse, $this->logger);

            $controller->setContainer($this->container);
            try {
                //before we attempt to continue, check to see if there is an
                //validation exception flag
                if (!is_null($httpRequest->getAttribute('ExceptionOccurred'))) {
                    throw new ValidationFailedException();
                }
                return call_user_func_array(array(
                    $controller,
                    $this->method
                        ), !isset($this->params) ? array() : $this->params);
            } catch (ValidationFailedException $ve) {
                //stop processing and return the failed list to the view.
                //currently this is only thrown by ajax requests since a POST
                //request will redirect to the calling page
                $view = new AJAXExceptionView($this->logger, 'exception_ajax', $this->agentType, $httpRequest, $httpResponse);
                $view->setData($httpRequest->getAttribute('ERROR_RESULT'));
                $view->setContainer($this->container);
                $view->setYmlKey('exception_ajax');
                $controller->setView($view);

                return $controller->render($httpRequest->getAttribute('AJAX_ERROR_RESULT'));
            } catch (\Exception $e) {
                echo "standard error\r\n";
                echo $e->getMessage();
                //die($e->getMessage());
                //TODO: this currently is only for the template view
                //$view = new TemplateExceptionView($this->logger, __YML_KEY, $this->agentType, $httpRequest, $e);
                $view = new $this->viewName($this->logger, 'exception', $this->agentType, $httpRequest, $httpResponse);
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

    private function checkStaticCache(HTTPRequest $httpRequest) {

        $cache = $httpRequest->getAttribute('CACHED_PAGE_ON_ENTRY_POINT');

        if (!is_null($cache)) {

            return $cache;
        }

        $cache = $httpRequest->getAttribute($this->modelName . '_static');

        return $cache;
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
