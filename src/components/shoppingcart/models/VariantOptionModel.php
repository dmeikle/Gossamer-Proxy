<?php

namespace components\shoppingcart\models;


use core\AbstractModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;

class VariantOptionModel extends AbstractModel
{
     
    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger)  {
        parent::__construct($httpRequest, $httpResponse, $logger);
        
        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
        
        $this->entity = 'CartVariantItem';
        $this->tablename = 'cartvariantItems';
    }
    
    public function getOptionsByVariantId($id) {
      
        $defaultLocale =  $this->getDefaultLocale();
        $params = array(
            'VariantGroups_id' => intval($id),
            'locale' => $defaultLocale['locale']
        );
       
        $result = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_LIST, $params);
       
        $data = array_key_exists('VariantItems', $result)? array('VariantOptions' => ($result['VariantItems'])) : array('VariantOptions');
        $data['Locales'] = $this->httpRequest->getAttribute('locales');
    
        return ($data);
    }
    
    public function listAllOptions() {
        $defaultLocale = $this->getDefaultLocale();
        $params = array('locale' => $defaultLocale['locale']);
        return $this->dataSource->query(self::METHOD_GET, $this, self::VERB_LIST, $params);
    }
//    
//    public function listall($offset = 0, $limit = 10) {
//        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_LIST, $params);
//        
//        return (array_key_exists('VariantItems', $data)? $data['VariantItems'] : array());
//    }
    
    public function saveOption($groupId, $optionId) {
        $params = $this->httpRequest->getPost();
        $params['variantItem']['id'] = intval($optionId);
        $params['variantItem']['VariantGroups_id'] = $groupId;
        file_put_contents('/var/www/shoppingcart/logs/test.log', print_r($params, true) . "\r\n", FILE_APPEND);

        $data = $this->dataSource->query(self::METHOD_POST, $this, self::VERB_SAVE, $params['variantItem']); 
       
        return ($data);
    }
    
    public function editOption($groupId, $optionId) {
      
        $defaultLocale =  $this->getDefaultLocale();
        $params = array(
            'VariantItems_id' => intval($optionId)
        );
       
        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_GET, $params);
        if(is_null($data)) {
            $data = array();
        }
        if(!array_key_exists('VariantItem', $data)) {
            $data['VariantItem'] = array();
        }
        $data['Locales'] = $this->httpRequest->getAttribute('locales');
    
        return ($data);
    }
}
