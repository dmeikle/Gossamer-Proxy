<?php

namespace components\defaultItem\controllers;

use core\AbstractController;

class DefaultController extends AbstractController
{
    public function index() {
        $params = array('title' => 'Asian Home Decor | Wall Art', 'pageTitle' => 'Home');
        $result = $this->model->index($params);
        
        $this->render($result);
    }
    
    public function about() {
        $params = array('title' => 'Wall Art Tablets | Home Decor', 'pageTitle' => 'About');
        $this->model->index($params);
    }
    
    public function contact() {
        $params = array('title' => 'Phoenix Restorations | Contact', 'pageTitle' => 'Contact');
        $result = $this->model->index($params);
       
        $this->render($result);
    }
}
