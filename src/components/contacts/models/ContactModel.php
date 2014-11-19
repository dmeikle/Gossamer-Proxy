<?php

namespace components\contacts\models;

use core\AbstractModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;
use core\eventlisteners\Event;


class ContactModel extends  AbstractModel
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
        echo 'inside save<br>';
         $params = $this->httpRequest->getPost();
        $params['Contact']['id'] = intval($id);
        $params['Contact']['password'] = crypt($params['Contact']['password']);
        unset($params['Contact']['passwordConfirm']);
        
        $data = $this->dataSource->query(self::METHOD_POST, $this, 'saveContact', $params);  
        
        $this->container->get('EventDispatcher')->dispatch(__YML_KEY, 'save_success', new Event('save_success', $data['Contact'][0]));
        
        return array('Contact' =>$data['Contact'][0], 'roles' => array());
    }
    
    
    public function edit($id) {
       
        $params = array('id' => $id);
      
        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_GET, $params);
        
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
}
