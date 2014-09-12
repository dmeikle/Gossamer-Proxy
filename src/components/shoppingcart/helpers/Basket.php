<?php
namespace components\shoppingcart\helpers;
use components\shoppingcart\helpers\BasketItem;
use components\shoppingcart\exceptions\BasketItemNotFoundException;

/**
 * Description of Basket
 *
 * @author user
 */
class Basket {
    
    private $list = null;
    
    private $defaultLocale;
    
    public function construct($defaultLocale = 'en_US') {
        $this->defaultLocale = $defaultLocale;
    }
    public function add(BasketItem $item) {
        $key = uniqid();
        
        $this->list[$key] = $item->setKey($key);
       
    }
    
    public function remove($key) {
        if(!array_key_exists($key, $this->list)) {
            throw new BasketItemNotFoundException($key . ' does not exist in basket list');
        }
        $this->subTotal -= $this->list[$key]->getSubtotal();
        
        unset($this->list[$key]);
    }
    
    public function getCount() {
        return count($this->list);
    }
    
    public function getSubtotal() {
        $total = 0;
        foreach($this->list as $item) {
            $total += floatval(str_replace(',','',$item->getSubTotal()));
        }
        
        return $total;
    }
    
    public function getTotalWeight() {
        $total = 0;
        foreach($this->list as $item) {
            $total += $item->getWeight();
        }
        
        return $total;
    }
    
    public function next() {
        return each($this->list);
    }
    
    public function items() {
        return $this->list;
    }
    
    public function getItemsAsArray() {
        $retval = array();
        foreach($this->list as $item) {
            $retval[] = $item->getArray();
        }
        
        return $retval;
    }
    
    public function populate(array $list) {
        foreach($list as $listItem) {
            $this->add(new BasketItem($listItem));
        }
    }
}
