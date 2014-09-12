<?php

namespace components\shoppingcart\helpers;

/**
 * Description of BasketItem
 *
 * @author user
 */
class BasketItem {
    private $quantity;
    
    private $productId;
    
    private $shipsSeparately = false;
    
    private $weight;
    
    private $price;
    
    private $customText;
    
    private $key;
    
    private $title;
    
    private $defaultLocale = 'en_US';
    
    
    public function __construct(array $params) {
        $this->productId = $params['id'];
        $this->quantity = $params['quantity'];
        $this->weight = $params['weight'];
        $this->shipsSeparately = $params['shipsSeparately'];
        if(array_key_exists('priceUSD', $params)) {
            $this->price = $params['priceUSD'];
        } else {
            $this->price = $params['price'];
        }
        if(array_key_exists('defaultLocale', $params)) {
            $this->defaultLocale = $params['defaultLocale'];
        }
        $this->customText = $params['customText'];
        if(array_key_exists('locales', $params)) { //it's a customer load
            foreach($params['locales'] as $locale => $values) {           
                $this->title[$locale] = $params['locales'][$locale]['title'];
            }
        }
        if(array_key_exists('ProductsI18n', $params)) { //it's an admin load
            foreach($params['ProductsI18n'] as $item) {
                $this->title[$item['locale']] = $item['title'];
            }
        }
        $this->checkVolumeDiscounts($params);
        
    }
    
        
    private function checkVolumeDiscounts(array $params) {
        
        if(array_key_exists('VolumeDiscount', $params)) { //it's an admin load
            foreach($params['VolumeDiscount'] as $item) {
                
                if($item["quantity"] <= $this->quantity) {
                    $this->price = $item['price'];
                }
            }
        }
       
    }
    public function getTitle($locale) { 
       if(array_key_exists($locale['locale'], $this->title)) {
           return $this->title[$locale['locale']];
       }
       return $this->title[$this->defaultLocale]; 
    }
    
    public function getQuantity() {
        return $this->quantity;
    }
    
    public function getId() {
        return $this->productId;
    }
    
    public function getShipsSeparately() {
        return $this->shipsSeparately;
    }
    
    public function getWeight() {
        return $this->weight;
    }
    
    public function getPrice() {
        return $this->price;
    }
    
    public function getCustomText() {
        return $this->customText;
    }
    
    public function getSubTotal() {
        return number_format(($this->quantity * $this->price), 2);
    }
    
    public function getTotalWeight() {
        return $this->quantity * $this->weight;
    }
    
    public function setKey($key) {
        $this->key = $key;
        
        return $this;
    }
    
    public function getKey() {
        return $this->key;
    }
    
    public function getArray() {
        return array(
            'quantity' => $this->quantity,
            'Products_id' => $this->productId,
            'shipsSeparately' => $this->shipsSeparately,
            'weight' => $this->weight,
            'price' => $this->price,
            'customText' => $this->customText,
            'title' => $this->title        
        );
    }
}
