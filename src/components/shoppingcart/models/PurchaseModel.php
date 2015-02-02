<?php

namespace components\shoppingcart\models;

use core\AbstractModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;
use components\shoppingcart\helpers\Basket;
use components\shoppingcart\models\ClientModel;

/**
 * Description of SaleModel
 *
 * @author Dave Meikle
 */
class PurchaseModel extends AbstractModel{
    
    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger)  {
        parent::__construct($httpRequest, $httpResponse, $logger);
        
        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
        
        $this->entity = 'CartPurchase';
        $this->tablename = 'cartpurchases';
        
    }
    
    public function edit($id) {
       
        $params = array(
            'id' => intval($id)
        );
    
        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_GET, $params);
       
        $purchase = current($data['CartPurchase']);
       
        $purchase['total'] = $purchase['tax1'] + $purchase['subtotal'];
        $purchaseItems = $purchase['CartPurchaseItem'];
        unset($purchase['CartPurchaseItem']);
        
        $basket = new Basket();        
        $basket->populate($purchaseItems);
       
        $defaultLocale =  $this->getDefaultLocale();
        return (array('purchase' => $purchase, 'basket' => $basket, 'locale' => $defaultLocale['locale']));
    }
    
    public function editPurchase() {
        $params = $this->httpRequest->getPost();
        $data = array('id' => $params['clientId'], $params['id'] => $params['value']);
        $data = $this->dataSource->query(self::METHOD_PUT, new ClientModel($this->httpRequest, $this->httpResponse, $this->logger), self::VERB_SAVE, $data);
        
        return (array($params['value']));
    }
    
    public function listall($offset = 0, $rows = 20, $customVerb = null) {
        $params = array(
            'directive::OFFSET' => $offset, 'directive::LIMIT' => $rows, 'directive::ORDER_BY' => 'CartPurchases.id', 'directive::DIRECTION' => 'desc'
        );
      
       // $params['locale'] = $this->getDefaultLocale();
        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_LIST, $params);
     
       
        $data['pagination'] = $this->getPagination($data['CartPurchasesCount'], $offset, $rows);
        return ($data);
    }
     
    public function delete() {
        $params = $this->httpRequest->getPost();
     
        $data = $this->dataSource->query(self::METHOD_DELETE, $this, self::VERB_DELETE, $params);
        
        $this->listall(0, 20);
    }
    
    public function getSalesTotals() {
        return (array());
    }
}
