<?php


namespace core;

use core\http\HTTPResponse;
use core\http\HTTPRequest;
use core\AbstractModel;
use core\AbstractView;
use core\ViewInterface;
use Monolog\Logger;

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

    /**
     * default constructor
     * 
     * @param Request filtered request values
     * @param Registry values to be built upon throughout the response
     * 
     */
    public function __construct(AbstractModel $model, AbstractView $view, Logger $logger) {
       
        $this->controllerName = strtolower(get_class($this));
        

        //TODO - this should be injectable so we can implement new JSONResultsView 
        $this->view = $view;
        $this->model = $model;
        $this->model->setView($view);

    }

    /**
     * index method - landing page or list view 
     * 
     */
    public function index(){
        $this->model->index();
    }

    /**
     * listall - retrieves rows based on offset, limit
     * 
     * @param int offset    database page to start at
     * @param int limit     max rows to return
     */
    public function listall($offset=0, $limit=20) {
        $this->model->listall($offset, $limit);
    }

    /**
     * edit - display an input form based on requested id
     * 
     * @param int id    primary key of item to edit
     */
    public function edit($id) {
        $this->model->edit($id);
    }

    /**
     * save - saves/updates row
     * 
     * @param int id    primary key of item to save
     */
    public function save($id) {
        $this->model->save($id);
    }

    /**
     * delete - removes a row from the database
     * 
     * @param int id    primary key of item to delete
     */
    public function delete($id) {
        $this->model->delete($id);
    }

    protected function redirect($uri) {
        echo "redirect $uri";
        /* Redirect browser */
        header("Location: $uri");

        /* Make sure that code below does not get executed when we redirect. */
        exit;
    }
}
