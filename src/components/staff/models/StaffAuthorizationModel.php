<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\staff\models;


use core\AbstractModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;
use core\eventlisteners\Event;
use Gossamer\CMS\Forms\FormBuilderInterface;
use components\users\lib\Password;

/**
 * Description of UserAuthorizationModel
 *
 * @author Dave Meikle
 */
class StaffAuthorizationModel extends AbstractModel implements FormBuilderInterface{
    
    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger)  {
        parent::__construct($httpRequest, $httpResponse, $logger);
        
        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
        
        $this->entity = 'StaffAuthorization';
        $this->tablename = 'staffauthorizations';        
    }
    
    public function saveCredentials($id) {
        
        $params = $this->httpRequest->getPost();
        $member = $this->httpRequest->getAttribute('components\\staff\\models\\StaffAuthorizationModel');
        
        $params['StaffAuthorization']['password'] = crypt($params['StaffAuthorization']['password']);
        $password = new Password();
        $params['StaffAuthorization']['passwordHistory'] = $password->formatPasswordHistory($params['StaffAuthorization']['password'], $member);
        $params['StaffAuthorization']['Staff_id'] = $id;
        unset($password);        
        unset($params['StaffAuthorization']['passwordConfirm']);
     
        
        $data = $this->dataSource->query(self::METHOD_POST, $this, 'save', $params['StaffAuthorization']);
      
        return $params['StaffAuthorization'];
    }
    

    
    public function savePermissions($id) {
       
        $params = $this->httpRequest->getPost();
        if(intval($id) > 0) {
            $params['staff']['id'] = intval($id);
            $params['userAuthorizations']['id'] = intval($id); 
        }
     
        $data = $this->dataSource->query(self::METHOD_POST, $this, 'saveAuthorizations', $params);
      
        return $params['userAuthorizations'];
        
    }
    
    
    public function edit($id) {
      
        $params = array(
            'Staff_id' => intval($id)
        );
    
        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_GET, $params);
        $staffAuthorization = array();
        if(!is_null($data) && array_key_exists('StaffAuthorization', $data)) {
            $staffAuthorization = current($data['StaffAuthorization']);
        }
//        $departments = $this->httpRequest->getAttribute('Departments');
//        $roles = explode('|', $staffAuthorization['roles']);
//        
//        return array('roles' => $roles, 'Departments' => $departments, 'Staff' => array('id' => $id));
        return array('StaffAuthorization' => $staffAuthorization);
    }

    public function getFormWrapper() {
        return $this->entity;
    }

}
