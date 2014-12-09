<?php

namespace components\incidents\models;

use core\AbstractModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;
use Gossamer\CMS\Forms\FormBuilderInterface;


/**
 * Description of PropertyModel
 *
 * @author davem
 */
class IncidentModel extends AbstractModel implements FormBuilderInterface {
    
    
    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger)  {
        parent::__construct($httpRequest, $httpResponse, $logger);
        
        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
        
        $this->entity = 'Incident';
        $this->tablename = 'incidents';
    }
    
  
    public function save($id) {
        $params = $this->httpRequest->getPost();
        $params[$this->entity]['id'] = intval($id);
        
        $data = $this->dataSource->query(self::METHOD_POST, $this, self::VERB_SAVE, $params[$this->entity]); 
      
        return $data;
    }
    
    
    public function listall($offset = 0, $rows = 20, $customVerb = NULL) {
        
        $data = parent::listall($offset, $rows, 'listIncidents');
                
        if(is_array($data) && array_key_exists('ScopeIncidentsCount', $data)) {
            $data['pagination'] = $this->getPagination($data['ScopeIncidentsCount'], $offset, $rows);
        } elseif (is_array($data) && array_key_exists(ucfirst($this->entity) . 'sCount', $data)) {
            $data['pagination'] = $this->getPagination($data[ucfirst($this->entity) . 'sCount'], $offset, $rows);
        }        
        
        return $data;
    }

    public function getFormWrapper() {
        return $this->entity;
    }

}
