<?php

namespace components\scoping\models;

use core\AbstractModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;

class ScopeRequestModel extends  AbstractModel
{
    
    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger)  {
        parent::__construct($httpRequest, $httpResponse, $logger);
        
        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
        
        $this->entity = 'ScopeRequest';
        $this->tablename = 'scoperequests';        
    }

    public function save($id) {
        
        $params = $this->httpRequest->getPost();
        $params['ScopeRequest']['id'] = $id;
      
        $data = $this->dataSource->query(self::METHOD_POST, $this, self::VERB_SAVE, $params['ScopeRequest']); 
       
        //need this for drawing the next page
        $data['scopeRequestId'] = $data['ScopeRequest'][0]['id'];
        
        $contactTypes = $this->httpRequest->getAttribute('ContactTypes');
        $unformattedTypes = $this->pruneArrayBeforeFormatting($contactTypes);
        
        $data['ContactTypes'] = $this->formatSelectionBoxOptions($unformattedTypes, array()); //TODO: array should be a loaded list
        
        return $data;
    }
    
    public function listall($offset = 0, $rows = 20) {
        
        $params = array(
            'directive::OFFSET' => $offset, 'directive::LIMIT' => $rows, 'directive::ORDER_BY' => 'id asc'
           
        );
        
        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_LIST, $params);
        
        if(is_array($data) && array_key_exists(ucfirst($this->tablename) . 'Count', $data)) {
            $data['pagination'] = $this->getPagination($data[ucfirst($this->tablename) . 'Count'], $offset, $rows);
        }
       
        return $data;
    }
    
    public function saveContact($id) {
        $params = $this->httpRequest->getPost();
        
         $data = $this->dataSource->query(self::METHOD_POST, $this, self::VERB_SAVE, $params);
      
         return $data;
    }
    
    public function loadContact($id) {
       
        $params = array('id' => $id);
      
        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_GET, $params);
        
        $contactTypes = $this->httpRequest->getAttribute('ContactTypes');
        $unformattedTypes = $this->pruneArrayBeforeFormatting($contactTypes);
        
        $data['ContactTypes'] = $this->formatSelectionBoxOptions($unformattedTypes, array()); //TODO: array should be a loaded list
               
        $data['scopeRequestId'] = $this->httpRequest->getQueryParameter('scopeRequestId');
        
        return $data;
    }
    
    private function pruneArrayBeforeFormatting(array $result) {
        $retval = array();
      
        foreach($result as $row) {
            $retval[$row['ContactTypes_id']] = $row['contactType'];
        }
        
        return $retval;
    }
    
    public function searchContact($projectAddressId, $unitNumber) {
        $params = array('ProjectAddresses_id' => $projectAddressId, '');
       
        $data = $this->dataSource->query(self::METHOD_GET, $this, 'search', $params['keywords']); 
       
        return $this->formatResults(current($data['ProjectAddresses']));
    }
    
   
}
