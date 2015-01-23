<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\shoppingcart\models;


use core\AbstractModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;

class ProductModel extends AbstractModel
{
    
    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger)  {
        parent::__construct($httpRequest, $httpResponse, $logger);
        
        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
        
        $this->entity = 'CartItem';
        $this->tablename = 'products';
    }
    
    
    public function listAllByCategoryId($category, $offset, $limit) {
       
        $params = ((strlen($category) > 0)? array('category' => $category ) : array());
        $params[self::DIRECTIVES] = array('offset' => $offset, 'limit' => $limit);
        
        
        $defaultLocale =  $this->getDefaultLocale();
    
        $params['locale'] = $defaultLocale['locale'];
        
        $data = $this->dataSource->query(self::METHOD_GET, $this, 'listByCategory', $params);
        $data['pageTitle'] = 'Art Wall Tablets';
        $data['title'] = 'Home Decor | Glen Meikle';
        $this->render($data);
    }
   
    public function get($itemId) {
        $params = array('id' => $itemId );
        
        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_GET, $params);
      
        $data['pageTitle'] = 'Art Wall Tablets';
        $this->render($data);
    }
    
    
    public function edit($id) {
       
        $params = array(
            'id' => intval($id)
        );
       
        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_GET, $params);
       
        //loaded from event dispatcher
        $data['categoryList'] = $this->httpRequest->getAttribute('categoryList');
        $data['categoryOptions'] = $this->formatSelectionBoxOptions($data['categoryList'], array_column($data['Product'][0]['ProductCategory'], 'Categories_id'));
        $this->render($data);
    }
    
    public function save($id) {

        $params = $this->httpRequest->getPost();
        $params['product']['id'] = $id;

        $data = $this->dataSource->query(self::METHOD_POST, $this, self::VERB_SAVE, $params['product']); 
       
        $data['categoryList'] = $this->httpRequest->getAttribute('categoryList');
      
        
        //$this->render($data);
    }
    
    public function delete($itemId) {
        $params = $this->httpRequest->getPost();
        
        $data = $this->dataSource->query(self::METHOD_DELETE, $this, self::VERB_DELETE, $params);
        
        $this->render($data);
    }
}
