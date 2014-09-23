<?php

namespace components\shoppingcart\models;


use core\AbstractModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;

class VariantGroupModel extends AbstractModel
{
    
    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger)  {
        parent::__construct($httpRequest, $httpResponse, $logger);
        
        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
        
        $this->entity = 'variantGroups';
        $this->tablename = 'variantGroups'; 
    }
    
    public function getAllVariantsForListing() {
        
        $params = array();
        $defaultLocale =  $this->getDefaultLocale();
        $params['locale'] = $defaultLocale['locale'];
       
        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_LIST, $params);
        $variants = current($data['VariantGroups']);
      
        $optionModel = new VariantOptionModel($this->httpRequest, $this->httpResponse, $this->logger);
        $optionModel->setDataSource($this->dataSource);
        $data = $optionModel->listAllOptions();
        $optionsList = current($data['VariantItems']);
        $data = array();
        $retval = array();
        foreach($variants as $variant) {
            $item = array();
            foreach($optionsList as $option) {
                $item = array('parent' => $option);                
                if($variant['VariantGroups_id'] == $option['VariantGroups_id']) {
                    $variant['child'][] = $option;
                }
            }
            $retval[] = $variant;
        }
        
        $this->render(array('variants' => $retval));
    }
    
    public function saveAllVariantsAndOptions($id) {
        
        $params = $this->httpRequest->getPost();
        $params['variant']['Products_id'] = $id;
       
        $pvim = new ProductVariantItemModel($this->httpRequest, $this->httpResponse, $this->logger);
        //need to query for SaveProductVariants
        $data = $this->dataSource->query(self::METHOD_POST, $pvim, 'SaveProductVariants', array('variant' => $params['variant'])); 
      
       
    }
    
    public function listall($offset = 0, $rows = 20) {
       
        $params = array(
            //'directive::OFFSET' => $offset, 'directive::LIMIT' => $limit, 'directive::ORDER_BY' => 'Products.id asc'
            'directive::OFFSET' => $offset, 'directive::LIMIT' => $rows
        );
        $defaultLocale =  $this->getDefaultLocale();
        $params['locale'] = $defaultLocale['locale'];
       
        $result = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_LIST, $params);
    
        $data = array('ProductVariants' => current($result['VariantGroups']));
        $data['ProductVariantOptions'] = $this->getAllVariantOptions();
        
        if(array_key_exists(ucfirst($this->tablename) . 'Count', $result)) {
            $data['pagination'] = $this->getPagination($result[ucfirst($this->tablename) . 'Count'], $offset, $rows);
        }
        
        $this->render($data);
    }
   
    private function getAllVariantOptions() {
        $variantOptionModel = new VariantOptionModel($this->httpRequest, $this->httpResponse, $this->logger);
        $defaultLocale =  $this->getDefaultLocale();
        $params['locale'] = $defaultLocale['locale'];
        $result = $this->dataSource->query(self::METHOD_GET, $variantOptionModel, self::VERB_LIST, $params);
 
        return array(current($result['VariantItems'][0]));
    }
    
    public function get($itemId) {
        $params = array('id' => intval($itemId ));
        
        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_GET, $params);
      
        //$data['pageTitle'] = 'Art Wall Tablets';
        $this->render($data);
    }
    
    
    public function edit($id) {
       
        $params = array(
            'id' => intval($id)
        );
       
        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_GET, $params);
        if(is_null($data)) {
            $data = array();
        }
        if(!array_key_exists('VariantGroup', $data)) {
            $data['VariantGroup'] = array();
        }
         $this->render($data);
    }
    
    public function save($id) {

        $params = $this->httpRequest->getPost();
        
        $params['variantGroup']['id'] = $id;

        $data = $this->dataSource->query(self::METHOD_POST, $this, self::VERB_SAVE, $params['variantGroup']); 
       
       // $data['categoryList'] = $this->httpRequest->getAttribute('categoryList');
      
        
        //$this->render($data);
    }
    
    public function delete($itemId) {
        $params = $this->httpRequest->getPost();
        
        $data = $this->dataSource->query(self::METHOD_DELETE, $this, self::VERB_DELETE, $params);
        pr($data);
        die;
        $this->render($data);
    }
    
    
   
}
