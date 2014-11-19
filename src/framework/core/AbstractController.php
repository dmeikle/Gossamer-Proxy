<?php


namespace core;

use core\http\HTTPRequest;
use core\AbstractModel;
use core\AbstractView;
use Monolog\Logger;
use core\system\KernelEvents;
use libraries\utils\Container;



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
//       echo'hehre ' .  __YML_KEY.'<bR>';
//       echo $_SERVER['REQUEST_METHOD'];
//       die;
        $this->controllerName = strtolower(get_class($this));
        
        $this->logger = $logger;
        $this->view = $view;
        $this->model = $model;
        //$this->model->setView($view);
        $this->httpRequest = $request;

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
      
        $this->render($result);
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
        
        $this->render($result);
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
}
