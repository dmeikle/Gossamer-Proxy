<?php

namespace components\staff\models;


use core\AbstractModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;
use core\eventlisteners\Event;


/**
 * Description of UserAuthorizationModel
 *
 * @author davem
 */
class StaffAuthorizationModel extends AbstractModel{
    
    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger)  {
        parent::__construct($httpRequest, $httpResponse, $logger);
        
        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
        
        $this->entity = 'StaffAuthorization';
        $this->tablename = 'staffauthorizations';        
    }
    
    
    public function savePermissions($id) {
       
        $params = $this->httpRequest->getPost();
        if(intval($id) > 0) {
            $params['staff']['id'] = intval($id);
            $params['userAuthorizations']['id'] = intval($id); 
        }
      
        $data = $this->dataSource->query(self::METHOD_POST, $this, 'saveAuthorizations', new Event('saveAuthorizations', $params));
       
        $this->container->get('EventDispatcher')->dispatch(__YML_KEY, 'save_success', $params['userAuthorizations']);        
        
        return array();
        
    }
    
    
    public function edit($id) {
      
        $params = array(
            'Staff_id' => intval($id)
        );
    
        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_GET, $params);
        
        $staffAuthorization = current($data['StaffAuthorization']);
        $departments = $this->httpRequest->getAttribute('Departments');
        $roles = explode('|', $staffAuthorization['roles']);
        
        return array('roles' => $roles, 'Departments' => $departments, 'Staff' => array('id' => $id));
    }
}
