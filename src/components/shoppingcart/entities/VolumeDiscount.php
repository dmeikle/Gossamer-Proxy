<?php

namespace components\shoppingcart\entities;

class VolumeDiscount extends Product {

    protected $quantity;
    protected $discount;

    public function setQuantity($qty) {
        $this->quantity = $qty;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function setDiscount($discount) {
        $this->discount = $discount;
    }

    public function getDiscount() {
        return $this->discount;
    }

}
