<?php

namespace components\shoppingcart\controllers;

use core\AbstractController;

class ProductsController extends AbstractController
{
    
    public function listAllByCategoryId($categoryId = 0, $offset=0, $limit = 20) {

        $result = $this->model->listAllByCategoryId($categoryId, $offset, $limit);
        
        $this->render($result);
    }

    public function get($category, $id, $name) {
      
        $result = $this->model->get($id);
        
        $this->render($result);
    }

    /**
     * save - saves/updates row
     *
     * @param int id    primary key of item to save
     */
    public function save($id) {
        $this->model->save($id);
        $this->redirect('/admin/cart/products/0/20');
    }

}
