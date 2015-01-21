<?php

namespace core\components\cms\controllers;

use core\AbstractController;

class PagesController extends AbstractController
{
    public function search($id) {
        $result = $this->model->search($id);
        
        $this->render($result);
    }
    
    public function savePermalink() {
        $result = $this->model->savePermalink();
        
        $this->render($result);
    }
    
    public function preview($id) {
        $result = $this->model->preview($id);
        
        $this->render($result);
    }
    
    public function viewByPermalink($section1, $section2 = '', $section3 = '') {
        echo $section1.'<br>';
        $result = $this->model->viewByPermalink($section1, $section2, $section3);
        
        $this->render($result);
    }
}
