<?php


namespace components\claims\models;


use core\AbstractModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;
/**
 * Description of LocationsWork
 *
 * @author davem
 */
class LocationsWorkModel extends AbstractModel{
    
    
    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger)  {
        parent::__construct($httpRequest, $httpResponse, $logger);
        
        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
        
        $this->entity = 'LocationsWork';
        $this->tablename = 'locationswork';
    }
    
    
    
    public function listWork($claimId, $locationId) {
       
        $params = array('Claims_id' => $claimId, 'id' => $locationId);
        
        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_LIST, $params); 
        
        return $data;
    }
    
    
   
    public function locationHistory($claimId, $locationId) {        
       
        $params = array('Claims_id' => $claimId, 'id' => $locationId);
        
        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_LIST, $params); 
        
        return $data;
    }
}
