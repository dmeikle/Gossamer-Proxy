<?php

namespace components\shoppingcart\controllers;

use core\AbstractController;

class CategoriesController extends AbstractController
{
    
    public function listAll($categoryId = 0, $offset=0, $limit = 20) {
       
        $this->model->listAllByParentId($categoryId, $offset, $limit);
    }


}
