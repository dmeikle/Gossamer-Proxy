<?php

namespace components\shoppingcart\controllers;

use core\AbstractController;

class PurchasesController extends AbstractController
{
    public function editPurchase() {
        $this->model->editPurchase();
    }
}