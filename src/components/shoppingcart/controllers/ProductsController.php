<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\shoppingcart\controllers;

use core\AbstractController;

class ProductsController extends AbstractController
{
    
    public function listAllByCategoryId($categoryId = 0, $offset=0, $limit = 20) {

        $this->model->listAllByCategoryId($categoryId, $offset, $limit);
    }

    public function get($category, $id, $name) {
      
        $this->model->get($id);
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
