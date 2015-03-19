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
    
    private $variants = null;
    
    private $productVariants = null;
    
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
      
        if(array_key_exists('CartProductsI18n', $params)) { //it's an admin load
            foreach($params['CartProductsI18n'] as $item) {
                $this->title[$item['locale']] = $item['title'];
            }
        }
        if(array_key_exists('CartProductVariant', $params)) {
            $this->productVariants = $params['CartProductVariant'];
        }
       
        if(array_key_exists('CartPurchaseItemsVariants', $params)) {
            $this->populateVariants($params['CartPurchaseItemsVariants']);
        }
        
        $this->checkVolumeDiscounts($params);
       
    }
    
    /*
     * because from the database it's a different method of stringing the params onto the object
     */
    private function populateVariants(array $variants) {    
        die('populate');
       $this->variants = array();
        foreach($variants as $variant) {      
          
             $this->variants[] = array('color' => array(
                'surcharge' => $variant['surcharge'],
                 'id' => $variant['CartProductVariants_id']
             ));
        }  
    }
    
    public function getVariants() {
        echo 'getvariants<br>';
        pr($this->variants);
        return $this->variants;
    }
    
    public function getVariantSurcharges() {
        if(is_null($this->variants)) {
            return 0;
        }       
        
        $total = 0;
            
        foreach($this->variants as $variant) {
            foreach($variant as $key => $item) {
                $total += intval($item['surcharge']);
            }
        }
        
        return $total;
    }
    
    public function setVariants(array $values) {
        foreach($this->productVariants as $variant) {
            $item = $this->filterVariants($variant, $values);
            if($item !== false) {
               
                $this->variants[] = $item;
            }
        }
     
    }

    private function filterVariants(array $variant, array $values) {
    
        foreach($values as $key => $item) {
          
            if($item['id'] == $variant['CartVariantItems_id']) {
                return array($key => array('surcharge' => $item['surcharge'], 'id' => $variant['CartVariantItems_id'], 'title' => $item['variant']));
            }
        }
        return false;
    }
    
    private function checkVolumeDiscounts(array $params) {
        if(array_key_exists('VolumeDiscount', $params) && is_array($params['VolumeDiscount'])) { //it's an admin load
            foreach($params['VolumeDiscount'] as $item) {
                
                if($item["quantity"] <= $this->quantity) {
                    $this->price = $item['price'];
                }
            }
        }
       
    }
    public function getTitle($locale) { 
        if(is_null($this->title)) {
            return '';
        }
        if(is_array($locale)) {
            if(array_key_exists($locale['locale'], $this->title)) {
                return $this->title[$locale['locale']];
            }
            return $this->title[$this->defaultLocale]; 
        }
        
        //it's a string passed in
       return $this->title[$locale]; 
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
            'title' => $this->title,
            'variants' => $this->variants
        );
    }
}
