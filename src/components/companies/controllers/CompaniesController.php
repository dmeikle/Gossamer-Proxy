<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

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
