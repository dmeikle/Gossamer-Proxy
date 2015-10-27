<?php

namespace components\shoppingcart\entities;

use components\shoppingcart\entities\Product;

class BasketItem extends Product {

    protected $quantity;
    protected $options = '';
    protected $key;
    protected $optionSurcharge;

    public function setQuantity($qty) {
        $this->quantity = $qty;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function setOptions($options) {
        $this->options = $options;
    }

    public function getOptions() {
        return $this->options;
    }

    public function setKey($key) {
        $this->key = $key;
    }

    public function getKey() {
        return $this->key;
    }

    public function setOptionsSurcharge($surcharge) {
        $this->optionSurcharge = $surcharge;
    }

    public function getOptionsSurcharge() {
        return $this->optionsSurcharge;
    }

}
