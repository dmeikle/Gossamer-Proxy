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
    public function __construct(AbstractModel $model, AbstractView $view, Logger $logger, HTTPRequest &$request, HTTPResponse &$response, Logger $logger) {

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

    public function autocomplete() {
        $params = $this->httpRequest->getQueryParameters();

        $this->render($this->model->autocomplete($params));
    }

    public function advancedSearch($offset = 0, $limit = 20) {
        $params = $this->httpRequest->getQueryParameters();
        //$data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_SEARCH, $params);

        $this->render($this->model->listallWithParams($offset, $limit, $params, 'search'));
    }

    protected function getSearchArguments() {
        $rawterm = $this->httpRequest->getQueryParameter('term');

        return preg_replace('/[^A-z0-9\-]/', '', substr($rawterm, 0, 10));
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
     * determines whether we are reloading the page after a failed validation
     *
     * @return boolean
     */
    protected function isFailedValidationAttempt() {
        return !is_null($this->httpRequest->getAttribute('ERROR_RESULT'));
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

        $this->view->render($data);
    }

    /**
     * index method - landing page or list view
     *
     */
    public function index() {
        $result = $this->model->index(array());

        $this->render($result);
    }

    /**
     * listall - retrieves rows based on offset, limit
     *
     * @param int offset    database page to start at
     * @param int limit     max rows to return
     */
    public function listall($offset = 0, $limit = 20) {
        $params = $this->httpRequest->getQueryParameters();
        $result = $this->model->listallWithParams($offset, $limit, $params, 'list');

        if (is_array($result) && array_key_exists($this->model->getEntity() . 'sCount', $result)) {
            $pagination = new Pagination($this->logger);

            //CP-33 changed to json output for new Angular based page draws
            $result['pagination'] = $pagination->getPaginationJson($result[$this->model->getEntity() . 'sCount'], $offset, $limit, $this->getUriWithoutOffsetLimit());
            unset($pagination);
        }

        $this->render($result);
    }

    /**
     * listall - retrieves rows based on offset, limit
     *
     * @param int offset    database page to start at
     * @param int limit     max rows to return
     */
    public function listallWithForm($offset = 0, $limit = 20) {
        $result = $this->model->listall($offset, $limit);
        $paginationResult = '';

        if (is_array($result) && array_key_exists($this->model->getEntity() . 'sCount', $result)) {
            $pagination = new Pagination($this->logger);
            $paginationResult = $pagination->paginate($result[$this->model->getEntity() . 'sCount'], $offset, $limit, $this->getUriWithoutOffsetLimit());
            unset($pagination);

            $this->render(array($this->model->getEntity() . 's' => current($result), 'pagination' => $paginationResult, 'form' => $this->drawForm($this->model, array())));
        } else {
            $this->render(array($this->model->getEntity() . 's' => $result, 'form' => $this->drawForm($this->model, array())));
        }
    }

    /**
     * listallReverseWithForm - retrieves rows based on offset, limit
     *
     * @param int offset    database page to start at
     * @param int limit     max rows to return
     */
    public function listallReverseWithForm($offset = 0, $limit = 20) {
        $result = $this->model->listallReverse($offset, $limit);

        if (is_array($result) && array_key_exists($this->model->getEntity() . 'sCount', $result)) {
            $pagination = new Pagination($this->logger);
            $paginationResult = $pagination->paginate($result[$this->model->getEntity() . 'sCount'], $offset, $limit, $this->getUriWithoutOffsetLimit());
            unset($pagination);

            $this->render(array($this->model->getEntity() . 's' => current($result), 'pagination' => $paginationResult, 'form' => $this->drawForm($this->model, array())));
        } else {
            $this->render(array($this->model->getEntity() . 's' => $result, 'form' => $this->drawForm($this->model, array())));
        }

        // $this->render($result);
    }

    /**
     * listallReverse - retrieves rows based on offset, limit
     *
     * @param int offset    database page to start at
     * @param int limit     max rows to return
     */
    public function listallReverse($offset = 0, $limit = 20) {
        $result = $this->model->listallReverse($offset, $limit);

        if (is_array($result) && array_key_exists($this->model->getEntity() . 'sCount', $result)) {
            $pagination = new Pagination($this->logger);

            //CP-33 changed to json output for new Angular based page draws
            $result['pagination'] = $pagination->getPaginationJson($result[$this->model->getEntity() . 'sCount'], $offset, $limit, $this->getUriWithoutOffsetLimit());
            unset($pagination);
        }

        $this->render($result);
    }

    /**
     *
     * @return string
     */
    protected function getUriWithoutOffsetLimit() {
        $pieces = explode('/', __URI);
        array_pop($pieces);
        array_pop($pieces);

        return '/' . implode('/', $pieces);
    }

    /**
     * edit - display an input form based on requested id
     *
     * @param int id    primary key of item to edit
     */
    public function edit($id) {
        $result = $this->model->edit($id);

        $this->render($result);
    }

    /**
     * edit - display an input form based on requested id
     *
     * @param int id    primary key of item to edit
     */
    public function get($id) {
        $result = $this->model->get($id);

        $this->render($result);
    }

    /**
     * save - saves/updates row
     *
     * @param int id    primary key of item to save
     */
    public function save($id) {

        $result = $this->model->save($id);

        $params = array('entity' => $this->model->getEntity(true), 'result' => $result, 'id' => $id);
        $event = new Event('save_success', $params);
        $this->container->get('EventDispatcher')->dispatch(__YML_KEY, 'save_success', $event);

        $this->render($result);
    }

    /**
     * saves values and performs a redirect upon completion
     *
     * @param int $id
     * @param string $ymlKey
     * @param array $params
     */
    protected function saveAndRedirect($id, $ymlKey, array $params) {
        $result = $this->model->save($id);

        $eventParams = array('entity' => $this->model->getEntity(true));
        $event = new Event('save_success', $eventParams);
        $this->container->get('EventDispatcher')->dispatch(__YML_KEY, 'save_success', $event);

        $router = new Router($this->logger, $this->httpRequest);
        $router->redirect($ymlKey, $params);
    }

    /**
     * delete - removes a row from the database
     *
     * @param int id    primary key of item to delete
     */
    public function delete($id) {
        $result = $this->model->delete($id);

        $this->render($result);
    }

    /**
     * view - dependent on listeners to provide all data
     *
     * @param int id    primary key of item to retrieve

      public function view($id = null) {


      $this->render(array());
      } */

    /**
     *
     * @param string $uri
     */
    protected function redirect($uri) {

        /* Redirect browser */
        header("Location: $uri");

        /* Make sure that code below does not get executed when we redirect. */
        exit;
    }

    /**
     * method for building forms within the view to be called if needed by
     * child classes
     *
     * @param FormBuilderInterface $model
     * @param array $values
     * @throws Exception
     */
    protected function drawForm(FormBuilderInterface $model, array $values = null) {
        throw new \Exception('drawFrom not overwritten by child class');
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

    public function setInactive($id) {
        $this->model->setInactive($id);

        $this->render();
    }

    protected function setInactiveAndRedirect($id, $ymlKey, array $params = array()) {
        $this->model->setInactive($id);

        $eventParams = array('entity' => $this->model->getEntity(true));
        $event = new Event('set_inactive_success', $eventParams);
        $this->container->get('EventDispatcher')->dispatch(__YML_KEY, 'set_inactive_success', $event);

        $router = new Router($this->logger, $this->httpRequest);
        $router->redirect($ymlKey, $params);
    }

    public function paginationJson($offset, $limit) {
        $result = $this->model->paginate($offset, $limit);

        if (is_array($result) && array_key_exists($this->model->getEntity() . 'sCount', $result)) {
            $pagination = new Pagination($this->logger);
            $count = $pagination->getPaginationJson($result[$this->model->getEntity() . 'sCount'], $offset, $limit);
            unset($pagination);
        }
//        //TODO: this is simply here for debugging and should be removed
//      $count = array();
//      $count[] = array("offset"=>"0","limit"=>"2","current"=>"");
//      $count[] = array("offset"=>"2","limit"=>"2","current"=>"");
//      $count[] = array("offset"=>"4","limit"=>"2","current"=>"current");
//      $count[] = array("offset"=>"6","limit"=>"2","current"=>"");
//      $count[] = array("offset"=>"8","limit"=>"2","current"=>"");
        $this->render($count);
    }

    /**
     *
     * @return Locale
     */
    protected function getDefaultLocale() {

        //check to see if it's in the query string - a menu request perhaps?
        $queryLocale = $this->httpRequest->getQueryParameter('locale');
        if (!is_null($queryLocale)) {
            return array('locale' => $queryLocale);
        }

        $manager = new UserPreferencesManager($this->httpRequest);
        $userPreferences = $manager->getPreferences();

        if (!is_null($userPreferences) && $userPreferences instanceof UserPreferences && strlen($userPreferences->getDefaultLocale()) > 0) {
            return array('locale' => $userPreferences->getDefaultLocale());
        }

        $config = $this->httpRequest->getAttribute('defaultPreferences');

        return $config['default_locale'];
    }

    /**
     * Creates a directory recursively.
     *
     * @param string|array|\Traversable $dirs The directory path
     * @param int                       $mode The directory mode
     *
     * @throws IOException On any directory creation failure
     */
    public function mkdir($dirs, $mode = 0777) {
        foreach ($this->toIterator($dirs) as $dir) {
            if (is_dir($dir)) {
                continue;
            }

            if (true !== @mkdir($dir, $mode, true)) {
                $error = error_get_last();
                if (!is_dir($dir)) {
                    // The directory was not created by a concurrent process. Let's throw an exception with a developer friendly error message if we have one
                    if ($error) {
                        throw new IOException(sprintf('Failed to create "%s": %s.', $dir, $error['message']), 0, null);
                    }
                    throw new IOException(sprintf('Failed to create "%s"', $dir), 0, null);
                }
            }
        }
    }

}
