<?php

namespace components\shoppingcart\controllers;

use core\AbstractController;

class VolumeDiscountsController extends AbstractController {

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
