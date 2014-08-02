<?php

namespace components\shoppingcart\controllers;

use core\AbstractController;

class CartController extends AbstractController
{
    
    public function add() {
       
        $this->model->add();
    }

    public function remove() {
        $this->model->remove();
    }

    public function checkout() {
        $this->model->checkout();
    }

    public function verify() {
        $this->model->verify();
    }

    public function confirm() {
        $this->model->confirm();
    }

    public function savePurchase() {
        $this->model->savePurchase();
    }
}
