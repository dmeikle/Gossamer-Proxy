<?php

namespace components\subcontractors\models;

use core\AbstractModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;

class SubcontractorContactModel extends  AbstractModel
{
    
    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger)  {
        parent::__construct($httpRequest, $httpResponse, $logger);
        
        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
        
        $this->entity = 'SubcontractorContact';
        $this->tablename = 'subcontractorcontacts';        
    }

    
    public function listallById($id) {
        
        $params = array(
            'Subcontractors_id' => $id
           
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
    
    
    public function searchContact($projectAddressId, $unitNumber) {
        $params = array('ProjectAddresses_id' => $projectAddressId, '');
       
        $data = $this->dataSource->query(self::METHOD_GET, $this, 'search', $params['keywords']); 
       
        return $this->formatResults(current($data['ProjectAddresses']));
    }
}
