<?php

namespace components\shoppingcart\models;

use core\AbstractModel;
use components\shoppingcart\helpers\BasketItem;
use components\shoppingcart\helpers\Basket;
use components\shoppingcart\exceptions\BasketItemNotFoundException;
use components\shoppingcart\models\ClientModel;
use components\shoppingcart\models\ClientShippingModel;

/**
 * Description of CartModel
 *
 * @author Dave Meikle
 */
class CartModel extends AbstractModel{
    
    public function add() {
        $params = $this->httpRequest->getPost();
      
        //load original to avoid tampering with price
        $basketItem = new BasketItem($this->getProduct($params['product']));
        $basketItem->setVariants($params['product']['variants']);
        $basket = $this->getBasket();
        
        $basket->add($basketItem);
        $this->setBasket($basket);
        
        $data['Basket'] = $basket;
        $defaultLocale =  $this->getDefaultLocale();
        
        $this->render(array('Basket' => $basket, 'locale' => $defaultLocale['locale'], 'pageTitle' => 'View Cart', 'title' => 'View Cart'));
    }
    
    public function checkout() {        
        $defaultLocale =  $this->getDefaultLocale();
        
        $this->render(array('Basket' => $this->getBasket(), 'locale' => $defaultLocale['locale'], 'title' => 'cart checkout', 'pageTitle' => 'Cart Checkout'));
    }
    
    public function verify() {
        $params = $this->httpRequest->getPost();
        $client = $params['client'];
        $shipping = (array_key_exists('shipping', $params))? $params['shipping'] : '';
        $purchase = $params['purchase'];     
        $defaultLocale =  $this->getDefaultLocale();
        $this->render(array(
            'Basket' => $this->getBasket(), 
            'locale' => $defaultLocale['locale'], 
            'client' => $client,
            'purchase' => $purchase,
            'shipping' => $shipping, 
            'title' => 'cart checkout', 
            'pageTitle' => 'Cart Checkout'));
    }
    
    public function savePurchase() {
        $params = $this->httpRequest->getPost();
        $client = $params['client'];
        $shipping = (array_key_exists('shipping', $params))? $params['shipping'] : '';
        $params['Basket'] = $this->getBasket()->getItemsAsArray();
        $params['purchase'] = array_merge( $params['purchase'], $this->generatePurchase());
        $params['purchase']['totalWeight'] = $this->getBasket()->getTotalWeight();
       
        $result = $this->dataSource->query(self::METHOD_POST, new ClientModel($this->httpRequest, $this->httpResponse, $this->logger), 'SavePurchase', $params);
       
        $defaultLocale =  $this->getDefaultLocale();
        $this->render(
            array(
                'title' => 'Purchase Complete', 'pageTitle' => 'Purchase Complete', 'Basket' => $this->getBasket(), 
                'client' => $client, 'Purchase' => current($result['Purchase']), 'locale' => $defaultLocale['locale']
            )
        );
    }
        
    private function generatePurchase() {
        return array(
            'PurchaseTypes_id' => '1',//eventually this will permit wholesale, retail, etc...
            'PaymentTypes_id' => '1', //credit card only for now...
            'status' => 'new',
            'orderDate' => date("Y-m-d H:i:s")
        );
    }
    public function remove() {
        $params = $this->httpRequest->getPost();        
        $product = $params['product'];      
        $basket = $this->getBasket();
        try{
            $basket->remove($product['key']);
        }catch(BasketItemNotFoundException $e){
            $this->logger->addInfo('user attempted to remove non-existing basket item');
        }
        $this->setBasket($basket);        
        
        $defaultLocale =  $this->getDefaultLocale();
        $this->render(array('Basket' => $basket, 'locale' => $defaultLocale['locale'], 'pageTitle' => 'View Cart', 'title' => 'View Cart'));
    }
    
    private function getProduct(array $rawProduct) {
        $id = key($rawProduct);
        $product = current($rawProduct);
       
        $params = array(
            'id' => intval($id)
        );
       
        $result = $this->dataSource->query(self::METHOD_GET, new ProductModel($this->httpRequest, $this->httpResponse, $this->logger), self::VERB_GET, $params);
        $dbProduct = current($result['Product']);
       
        $dbProduct['customText'] = (array_key_exists('customText', $product))? $product['customText'] : '';
        $dbProduct['quantity'] = $product['quantity'];
        
        return $dbProduct;
    }
    
    
    private function getBasket() {
       
        $basket = getSession('BASKET');
        
        if(is_null($basket)) {
            $basket = new Basket();
            $this->setBasket($basket);            
        }
        
        return $basket;
    }
    
    public function listall($offset=0, $limit=20) {
        $basket = $this->getBasket();          
        
        $defaultLocale =  $this->getDefaultLocale();
        
        $this->render(array('Basket' => $basket, 'locale' => $defaultLocale, 'title' =>' view cart', 'pageTitle' => 'View Cart'));
    }
    
    private function setBasket(Basket $basket) {
        $_SESSION['BASKET'] = $basket;
    }
}
