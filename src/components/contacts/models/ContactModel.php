<?php

namespace components\contacts\models;

use core\AbstractModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;
use core\eventlisteners\Event;
use Gossamer\CMS\Forms\FormBuilderInterface;

class ContactModel extends  AbstractModel implements FormBuilderInterface
{
    
    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger)  {
        parent::__construct($httpRequest, $httpResponse, $logger);
        
        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
        
        $this->entity = 'Contact';
        $this->tablename = 'contacts';        
    }
    
    public function login() {
       
    }
    
    public function save($id) {
        
        $params = $this->httpRequest->getPost();
        $params['Contact']['id'] = intval($id);
               
        $data = $this->dataSource->query(self::METHOD_POST, $this, 'saveContact', $params);  
                
        return array('Contact' =>$data['Contact'][0], 'roles' => array());
    }
    
    
    public function edit($id) {
       
        $params = array('id' => $id);
      
        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_GET, $params);
        if(is_array($data) && array_key_exists('Contact', $data)) {
            $data['Contact'] = current($data['Contact']);
        }
        
        $contactTypes = $this->httpRequest->getAttribute('ContactTypes');
        $unformattedTypes = $this->pruneArrayBeforeFormatting($contactTypes);
        
        //$contactTypes = $this->httpRequest->getAttribute('ContactTypes'); -pasted in for when this is a loaded list
       
        $data['ContactTypes'] = $this->formatSelectionBoxOptions($unformattedTypes, array()); //TODO: array should be a loaded list
         
        return $data;
    }
    
     private function pruneArrayBeforeFormatting(array $result) {
        $retval = array();
      
        foreach($result as $row) {
            $retval[$row['ContactTypes_id']] = $row['contactType'];
        }
        
        return $retval;
    }   
    
    public function view() {
        return array();
    }

    public function getFormWrapper() {
        return $this->entity;
    }

}
