<?php

namespace components\shoppingcart\controllers;

use core\AbstractController;

class PurchasesController extends AbstractController {

    public function editPurchase() {
        $result = $this->model->editPurchase();

        $this->render($result);
    }

    public function getSalesTotals() {
        $result = $this->model->getSalesTotals();

        $this->render($result);
    }

}
