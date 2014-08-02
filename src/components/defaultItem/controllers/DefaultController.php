<?php

namespace components\defaultItem\controllers;

use core\AbstractController;

class DefaultController extends AbstractController
{
    public function index() {
        $params = array('title' => 'Asian Home Decor | Wall Art', 'pageTitle' => 'Home');
        $this->model->index($params);
    }
    
    public function about() {
        $params = array('title' => 'Wall Art Tablets | Home Decor', 'pageTitle' => 'About');
        $this->model->index($params);
    }
    
    public function glenmeikle() {
        $params = array('title' => 'Home Decor | Glen Meikle', 'pageTitle' => 'About Glen Meikle');
        $this->model->index($params);
    }
    public function walltablets() {
        $params = array('title' => 'Wall Art Tablets | Home Decor', 'pageTitle' => 'About');
        $this->model->index($params);
    }
    public function design1() {
        $params = array('title' => 'Asian Home Decor', 'pageTitle' => 'Elements of Chinese and Western Design');
        $this->model->index($params);
    }
    public function design2() {
        $params = array('title' => 'Asian Home Decor | Feng Shui', 'pageTitle' => 'Elements of Chinese and Western Design');
        $this->model->index($params);
    }
    public function inspiration() {
        $params = array('title' => 'Asian Home Decor | Glen Meikle', 'pageTitle' => 'Inspiration');
        $this->model->index($params);
    }
    public function contact() {
        $params = array('title' => 'Asian Home Decor | Contact', 'pageTitle' => 'Contact');
        $this->model->index($params);
    }
}
