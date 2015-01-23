<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\shoppingcart\entities;


class VolumeDiscount extends Product
{
        
        
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
