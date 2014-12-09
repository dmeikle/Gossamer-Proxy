<?php

namespace components\shoppingcart\models;


use core\AbstractModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;

class VolumeDiscountModel extends AbstractModel
{
    
    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger)  {
        parent::__construct($httpRequest, $httpResponse, $logger);
        
        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
        
        $this->entity = 'VolumeDiscount';
        $this->tablename = 'volumeDiscounts';
    }
    
    
   
    public function get($itemId) {
        $params = array('id' => $itemId );
        
        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_GET, $params);
      
        $data['pageTitle'] = 'Art Wall Tablets';
        $this->render($data);
    }
    
    
    public function edit($id) {
       
        $params = array(
            'Products_id' => intval($id)
        );
       
        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_LIST, $params);
       
       
        $this->render($data);
    }
    
    public function save($id) {

        $params = $this->httpRequest->getPost();
        $params['product']['id'] = $id;
        $params['id'] = $id;
       
        $data = $this->dataSource->query(self::METHOD_POST, $this, self::VERB_SAVE, $params); 
       
    }
    
    public function delete($itemId) {
        $params = $this->httpRequest->getPost();
        
        $data = $this->dataSource->query(self::METHOD_DELETE, $this, self::VERB_DELETE, $params);
        
        $this->render($data);
    }
}
