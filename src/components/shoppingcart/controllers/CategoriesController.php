<?php

namespace components\shoppingcart\controllers;

use core\AbstractController;

class CategoriesController extends AbstractController {

    public function listAll($categoryId = 0, $offset = 0, $limit = 20) {

        $result = $this->model->listAllByParentId($categoryId, $offset, $limit);

        $this->render($result);
    }

    /**
     * save - saves/updates row
     *
     * @param int id    primary key of item to save
     */
    public function save($id) {
        $this->model->save($id);
        $this->redirect('/admin/cart/categories');
    }

}
