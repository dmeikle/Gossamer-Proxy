<?php


namespace core;

use core\http\HTTPRequest;
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


/**
 * AbstractController Class extending from XMLURIParser
 *
 * Author: Dave Meikle
 * Copyright: Quantum Unit Solutions 2013
 */
class AbstractController 
{
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
    public function __construct(AbstractModel $model, AbstractView $view, Logger $logger, HTTPRequest &$request, Logger $logger) {

        $this->controllerName = strtolower(get_class($this));
        
        $this->logger = $logger;
        $this->view = $view;
        $this->model = $model;
        //$this->model->setView($view);
        $this->httpRequest = $request;

    }
    
    protected function getEntity($key, array $values = array()) {
        $entity = new Entity();
        $entity->populate($key, $values);
        
        return $entity->getArray();
    }


    protected function isFailedValidationAttempt() {
        return !is_null($this->httpRequest->getAttribute('ERROR_RESULT'));
    }

        
    //injection method intended for overriding the default view in case of Exception
    public function setView(AbstractView $view) {
        $this->view = $view;
    }
    
    public function setContainer(Container $container) {
        $this->container = $container;
    }
    
    //changed from protected to public so render can be overridden during Exception
    public function render(array $data = null) {
        
        $this->container->get('EventDispatcher')->dispatch(__YML_KEY, KernelEvents::REQUEST_END);
        $this->view->render($data);
    } 
    
    
    /**
     * index method - landing page or list view 
     * 
     */
    public function index(){
        $result = $this->model->index(array());
        
        $this->render($result);
    }

    /**
     * listall - retrieves rows based on offset, limit
     * 
     * @param int offset    database page to start at
     * @param int limit     max rows to return
     */
    public function listall($offset=0, $limit=20) {
        $result = $this->model->listall($offset, $limit);
     
        if(is_array($result) && array_key_exists($this->model->getEntity() .'sCount', $result)) {
            $pagination = new Pagination($this->logger);        
            $result['pagination'] = $pagination->paginate($result[$this->model->getEntity() .'sCount'], $offset, $limit, $this->getUriWithoutOffsetLimit());       
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
    public function listallReverse($offset=0, $limit=20) {
        $result = $this->model->listallReverse($offset, $limit);
     
        if(is_array($result) && array_key_exists($this->model->getEntity() .'sCount', $result)) {
            $pagination = new Pagination($this->logger);        
            $result['pagination'] = $pagination->paginate($result[$this->model->getEntity() .'sCount'], $offset, $limit, $this->getUriWithoutOffsetLimit());       
            unset($pagination);
        }
        
        $this->render($result);
    }
    
    protected function getUriWithoutOffsetLimit() {
        $pieces = explode('/', __URI);
        array_pop($pieces);
        array_pop($pieces);
        
        return '/' . implode('/',$pieces);
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

    public function saveAndRedirect($id, $ymlKey, array $params) {
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

    protected function redirect($uri) {
       
        /* Redirect browser */
        header("Location: $uri");

        /* Make sure that code below does not get executed when we redirect. */
        exit;
    }
    
    protected function drawForm(FormBuilderInterface $model, array $values = null) {
        throw \Exception('drawFrom now overwritten by child class');
    }

    
    protected function getDatasource(AbstractModel $model) {
        
        $factory = $this->container->get('datasourceFactory');
        
        $sources = $this->container->get('datasources');
        $datasource = $factory->getDatasource($sources[get_class($model)], $this->logger);
        $datasource->setDatasourceKey($sources[get_class($model)]);
        
        return $datasource;
    }
    
    protected function getSecurityToken() {
        $serializedToken = getSession('_security_secured_area');
        $token = unserialize($serializedToken);
        
        return $token;
    }
    
    protected function getLoggedInUser() {
        $token = $this->getSecurityToken();
        
        return $token->getClient()->getId();
    }

}
