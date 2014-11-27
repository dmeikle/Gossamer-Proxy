<?php

namespace components\contacts\models;


use core\AbstractModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;
use core\eventlisteners\Event;
use Gossamer\CMS\Forms\FormBuilderInterface;

/**
 * Description of UserAuthorizationModel
 *
 * @author davem
 */
class ContactAuthorizationModel extends AbstractModel implements FormBuilderInterface{
    
    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger)  {
        parent::__construct($httpRequest, $httpResponse, $logger);
        
        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
        
        $this->entity = 'ContactAuthorization';
        $this->tablename = 'contactauthorizations';        
    }
    
    
    public function savePermissions($id) {
       
        $params = $this->httpRequest->getPost();
        if(intval($id) > 0) {
            $params['contact']['id'] = intval($id);
            $params['userAuthorizations']['id'] = intval($id); 
        }
       
        $data = $this->dataSource->query(self::METHOD_POST, $this, 'saveAuthorizations', $params);
       
        $this->container->get('EventDispatcher')->dispatch(__YML_KEY, 'save_success', new Event('save_success', $params));        
        
        return array();
        
    }
    
    
    public function edit($id) {
      
        $params = array(
            'Contacts_id' => intval($id)
        );
    
        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_GET, $params);
        $contactAuthorization = array('roles' => '');
        if(is_array($data) && array_key_exists('ContactAuthorization', $data)) {
            $contactAuthorization = current($data['ContactAuthorization']);
        }
        
        $contactTypes = $this->httpRequest->getAttribute('ContactTypes');

        $roles = explode('|', $contactAuthorization['roles']);
        if(is_null($roles)) {
            $roles = array();
        }
        
        return array('roles' => $roles, 'ContactTypes' => $contactTypes, 'Contact' => array('id' => $id));
    }

    public function getFormWrapper() {
        return $this->entity;
    }

}
