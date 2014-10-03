<?php

namespace components\shoppingcart\models;


use core\AbstractModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;

class StateModel extends AbstractModel
{
    
    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger)  {
        parent::__construct($httpRequest, $httpResponse, $logger);
        
        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
        
        $this->entity = 'State';
        $this->tablename = 'states';
    }
    
    
   
    public function get($itemId) {
        $params = array('id' => $itemId );
        
        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_GET, $params);
        
        $this->container->get('EventDispatcher')->dispatch(__YML_KEY, 'before_render_start', $data);
        
        $data['pageTitle'] = 'Art Wall Tablets';
        $data['title'] = 'Home Decor | ' . $data['Product'][0]['locales']['en_US']['title'];
        $data['ProductVariantList'] = $this->httpRequest->getAttribute('ProductVariantList');
        
        $this->render($data);
    }
    
    
    public function edit($id) {
       
        $params = array(
            'id' => intval($id)
        );
       
        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_GET, $params);
        
        //loaded from event dispatcher
        $data['categoryList'] = $this->httpRequest->getAttribute('categoryList');
        $productCategories = array();
        
        if(!is_null($data['Product'][0]['ProductCategory'])) {
            $productCategories = array_column($data['Product'][0]['ProductCategory'], 'Categories_id');
        }
      
        $data['categoryOptions'] = $this->formatSelectionBoxOptions($data['categoryList'], $productCategories);
     
        $this->render($data);
    }
    
    public function save($id) {
        
        $params = $this->httpRequest->getPost();
        $params['product']['id'] = $id;
      
        file_put_contents('/var/www/shoppingcart/logs/test.log', print_r($params, true) . "\r\n", FILE_APPEND);

        $data = $this->dataSource->query(self::METHOD_POST, $this, self::VERB_SAVE, $params['product']); 
       
        $data['categoryList'] = $this->httpRequest->getAttribute('categoryList');
      
    }
    
    public function delete($itemId) {
        $params = $this->httpRequest->getPost();
        
        $data = $this->dataSource->query(self::METHOD_DELETE, $this, self::VERB_DELETE, $params);
        
        $this->render($data);
    }
}
