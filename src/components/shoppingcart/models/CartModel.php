<?php

namespace components\shoppingcart\models;

use core\AbstractModel;
use components\shoppingcart\helpers\BasketItem;
use components\shoppingcart\helpers\Basket;
use components\shoppingcart\exceptions\BasketItemNotFoundException;
use components\shoppingcart\models\ClientModel;
use Gossamer\CMS\Forms\FormBuilderInterface;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;

/**
 * Description of CartModel
 *
 * @author Dave Meikle
 */
class CartModel extends AbstractModel implements FormBuilderInterface{
    
    
    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger)  {
        parent::__construct($httpRequest, $httpResponse, $logger);
        
        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
        
        $this->entity = 'Client';
        $this->tablename = 'carts';        
    }
    
    public function add() {
        $params = $this->httpRequest->getPost();
      
        //load original to avoid tampering with price
        $basketItem = new BasketItem($this->getProduct($params['product']));
        if(array_key_exists('variants', $params['product'])) {
            $basketItem->setVariants($params['product']['variants']);
        }
        
        $basket = $this->getBasket();
        
        $basket->add($basketItem);
        $this->setBasket($basket);
        
        $data['Basket'] = $basket;
        $defaultLocale =  $this->getDefaultLocale();
        $stateList = $this->formatSelectionBoxOptions($this->httpRequest->getAttribute('stateList'), array());
        
        return (array('Basket' => $basket, 
            'locale' => $defaultLocale['locale'], 
            'pageTitle' => 'View Cart', 
            'title' => 'View Cart',
            'stateList' => $stateList));
    }
    
    public function checkout() {        
        $defaultLocale =  $this->getDefaultLocale();
        
        return (array('Basket' => $this->getBasket(), 'locale' => $defaultLocale['locale'], 'title' => 'cart checkout', 'pageTitle' => 'Cart Checkout'));
    }
    
    public function verify() {
        $params = $this->httpRequest->getPost();
        $client = $params['client'];
        $shipping = (array_key_exists('shipping', $params))? $params['shipping'] : '';
        $purchase = $params['purchase'];     
        $defaultLocale =  $this->getDefaultLocale();
        //this is an array of Initials and ID
        
        $state = json_decode($client['state']);
        $shipState = json_decode($client['shipState']);
       
        $client['state'] = $state->state;
        $client['stateId'] = $state->id;
        $client['shipState'] = $shipState->state;
        $client['shipStateId'] = $shipState->id;
        $tax = $this->getTax($state->id, $this->getBasket()->getSubtotal());
        $total = $tax + $this->getBasket()->getSubtotal();
        
        return (array(
            'Basket' => $this->getBasket(), 
            'locale' => $defaultLocale['locale'], 
            'client' => $client,
            'purchase' => $purchase,
            'shipping' => $shipping, 
            'title' => 'cart checkout', 
            'pageTitle' => 'Cart Checkout',
            'tax' => $tax,
            'total' => $total));
    }
    
    private function getTax($stateId, $subtotal) {
        $model = new TaxModel($this->httpRequest, $this->httpResponse, $this->logger);
        $model->setDataSource($this->dataSource);
        
        $result = $model->getTax($stateId, $subtotal);
        if(!array_key_exists('taxRate', $result)) {
            return $subtotal;
        }
        
        return $result['taxRate'] * $subtotal;
    }
    
    public function savePurchase() {
        $params = $this->httpRequest->getPost();
        $client = $params['client'];
        $shipping = (array_key_exists('shipping', $params))? $params['shipping'] : '';
        $params['Basket'] = $this->getBasket()->getItemsAsArray();
        $params['purchase'] = array_merge( $params['purchase'], $this->generatePurchase());
        $params['purchase']['totalWeight'] = $this->getBasket()->getTotalWeight();
        $params['purchase']['subtotal'] = $this->getBasket()->getSubtotal();
        
        $result = $this->dataSource->query(self::METHOD_POST, new ClientModel($this->httpRequest, $this->httpResponse, $this->logger), 'SavePurchase', $params);
      
        if(is_null($result)) {
            die('there was an error saving');
            //there  was an error - handle it here. I suggest making render() receive an optional param to load a different view 
        }
       
        $defaultLocale =  $this->getDefaultLocale();
        return (
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
        $stateList = $this->formatSelectionBoxOptions($this->httpRequest->getAttribute('stateList'), array());
        
        return (array('Basket' => $basket, 'locale' => $defaultLocale['locale'], 'pageTitle' => 'View Cart', 'title' => 'View Cart', 'stateList' => $stateList));
    }
    
    private function getProduct(array $rawProduct) {
        $id = key($rawProduct);
        $product = current($rawProduct);
       
        $params = array(
            'id' => intval($id)
        );
       
        $result = $this->dataSource->query(self::METHOD_GET, new ProductModel($this->httpRequest, $this->httpResponse, $this->logger), self::VERB_GET, $params);
        $dbProduct = current($result['CartProduct']);
       
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
    
    public function listall($offset=0, $limit=20, $customVerb = null) {
        $basket = $this->getBasket();          
        
        $defaultLocale =  $this->getDefaultLocale();
        $stateList = $this->formatSelectionBoxOptions($this->httpRequest->getAttribute('stateList'), array());
        return (array('Basket' => $basket, 
            'locale' => $defaultLocale, 
            'title' =>' view cart', 
            'pageTitle' => 'View Cart',
            'stateList' => $stateList));
    }
    
    private function setBasket(Basket $basket) {
        $_SESSION['BASKET'] = $basket;
    }

    public function getFormWrapper() {
        return $this->entity;
    }

}
