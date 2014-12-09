<?php

namespace components\companies\controllers;

use core\AbstractController;

class CompaniesController extends AbstractController
{
    public function search() {
        $result = $this->model->search();
        
        return $this->render($result);
    }
    
    
    public function searchResults() {
        $result = $this->model->searchResults();
        $searchResults = $this->httpRequest->getAttributes('searchResults');
        
        return $this->render($result);
    }
}
