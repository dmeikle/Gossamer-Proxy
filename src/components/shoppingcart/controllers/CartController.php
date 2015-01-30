<?php

namespace components\shoppingcart\controllers;

use core\AbstractController;

class CartController extends AbstractController
{
    
    public function add() {
       
        $result = $this->model->add();
        
        $this->render($result);
    }

    public function remove() {
        $result = $this->model->remove();
        
        $this->render($result);
    }

    public function checkout() {
        $result = $this->model->checkout();
        
        $this->render($result);
    }

    public function verify() {
        $result = $this->model->verify();
        
        $this->render($result);
    }

    public function confirm() {
        $result = $this->model->confirm();
        
        $this->render($result);
    }

    public function savePurchase() {
        $result = $this->model->savePurchase();
        
        $this->render($result);
    }
}
