<?php

namespace components\shoppingcart\controllers;

use core\AbstractController;

class TaxesController extends AbstractController
{
    public function saveTaxes() {
        $this->model->save(0);
    }
}