<?php

namespace components\shoppingcart\controllers;

use core\AbstractController;

class TaxesController extends AbstractController {

    public function saveTaxes() {
        $result = $this->model->save(0);

        $this->render($result);
    }

    public function getTaxByStateSubtotal($stateId, $subtotal) {
        $result = $this->model->getTaxByStateSubtotal(intval($stateId), floatval($subtotal));

        $this->render($result);
    }

}
