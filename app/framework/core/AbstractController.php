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

use core\http\HTTPRequest;
use core\http\HTTPResponse;
use core\AbstractModel;
use core\AbstractView;
use Monolog\Logger;
use core\system\KernelEvents;
use libraries\utils\Container;
use core\Entity;
use Gossamer\CMS\Forms\FormBuilderInterface;
use core\system\Router;
use core\navigation\Pagination;
use core\eventlisteners\Event;
use libraries\utils\preferences\UserPreferences;
use libraries\utils\preferences\UserPreferencesManager;

/**
 * AbstractController Class extending from XMLURIParser
 *
 * Author: Dave Meikle
 * Copyright: Quantum Unit Solutions 2013
 */
class AbstractController {

    use \libraries\utils\traits\GetLoggedInUser;

    /**
     * Property: view
     * The view to be implemented within the MVC framework
     */
    protected $view = null;

    /**
     * Property: model
     * The model to be implemented within the MVC framework
     */
    protected $model = null;

    /**
     * Property: registry
     * The registry object to contain all request/response attributes
     */
    protected $registry;

    /**
     * Property: response
     * The response object to contain loaded parameters for the view
     */
    protected $httpResponse;

    /**
     * Property: request
     * The request object to contain filtered parameters from the $_REQUEST
     */
    protected $request;

    /**
     * Property: controllerName
     * The string value of the controller class
     */
    protected $controllerName;
    protected $container = null;
    protected $httpRequest = null;
    protected $logger = null;

    /**
     * default constructor
     *
     * @param Request filtered request values
     * @param Registry values to be built upon throughout the response
     *
     */
    public function __construct(AbstractModel &$model, AbstractView &$view, Logger &$logger, HTTPRequest &$request, HTTPResponse &$response) {

        $this->controllerName = strtolower(get_class($this));

        $this->logger = $logger;
        $this->view = $view;
        $this->model = $model;
        //$this->model->setView($view);
        $this->httpRequest = $request;
        $this->httpResponse = $response;
    }

    public function __call($name, $arguments) {
        $field = '';

        if (substr($name, 0, 7) == 'searchBy') {
            $field = substr($name, 8);
            $this->model->search(array($field => $this->getSearchArguments()));
        }
    }



    /**
     * creates a default entity and populates it
     *
     * @param string $key
     * @param array $values
     *
     * @return array
     */
    protected function getEntity($key, array $values = array()) {
        $entity = new Entity();
        $entity->populate($key, $values);

        return $entity->getArray();
    }


    /**
     * injection method intended for overriding the default view in case of Exception
     *
     * @param AbstractView $view
     */
    public function setView(AbstractView $view) {
        $this->view = $view;
    }

    /**
     * accessor
     *
     * @param Container $container
     */
    public function setContainer(Container $container) {
        $this->container = $container;
    }

    //changed from protected to public so render can be overridden during Exception
    /**
     * calls the render method within the passed in view
     *
     * @param array $data
     */
    public function render(array $data = null) {

        $this->container->get('EventDispatcher')->dispatch('all', KernelEvents::REQUEST_END);
        $this->container->get('EventDispatcher')->dispatch(__YML_KEY, KernelEvents::REQUEST_END);

        return $this->view->render($data);
    }

    /**
     * index method - landing page or list view
     *
     */
    public function index() {
        $result = $this->model->index(array());

        return $this->render($result);
    }



    /**
     * get - display an input form based on requested id
     *
     * @param int id    primary key of item to edit
     */
    public function get() {
        $params = $this->httpRequest->getQueryParameters();
        
        $result = $this->model->get($params);

        return $this->render($result);
    }
    
    /**
     * customGet - call a custom verb using GET method
     *
     * @param void
     */
    public function customGet() {
        $segments = $this->httpRequest->getUrlSegments();
        $verb = array_pop($segments);

        $params = $this->httpRequest->getQueryParameters();

        $result = $this->model->listallWithParams($params, $verb);

        return $this->render($result);
    }

    /**
     * customPost - call a custom verb using POST method
     *
     * @param void
     */
    public function customPost() {
        $segments = $this->httpRequest->getUrlSegments();
        $verb = array_pop($segments);

        $params = $this->httpRequest->getPost();

        $data = $this->model->save($params, $verb);


        $event = new Event('save_success', $data);
        $this->container->get('EventDispatcher')->dispatch(__YML_KEY, 'save_success', $event);

        return $this->render($data);
    }

    /**
     * save - saves/updates row
     *
     * @param int id    primary key of item to save
     */
    public function save() {
        $params = $this->httpRequest->getPost();

        $data = $this->model->save($params);


        $event = new Event('save_success', $data);
        $this->container->get('EventDispatcher')->dispatch(__YML_KEY, 'save_success', $event);

        return $this->render($data);
    }



    /**
     * listall - returns all rows
     *
     * @param void
     */
    public function listall() {
        $params = $this->httpRequest->getQueryParameters();

        $data = $this->model->listall($params);

        return $this->render($data);
    }




    /**
     * delete - removes a row from the database
     *
     * @param int id    primary key of item to delete
     */
    public function delete() {
        $params = $this->httpRequest->getPost();
        $result = $this->model->delete($params);

        return $this->render($result);
    }


    /**
     *
     * @param AbstractModel $model
     *
     * @return datasource
     */
    protected function getDatasource(AbstractModel $model) {

        $factory = $this->container->get('datasourceFactory');

        $sources = $this->container->get('datasources');
        $datasource = $factory->getDatasource($sources[get_class($model)], $this->logger);
        $datasource->setDatasourceKey($sources[get_class($model)]);

        return $datasource;
    }




}
