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
