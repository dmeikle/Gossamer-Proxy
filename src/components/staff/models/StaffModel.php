<?php

namespace components\staff\models;

use core\AbstractModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;
use core\eventlisteners\Event;
use Gossamer\CMS\Forms\FormBuilderInterface;

class StaffModel extends  AbstractModel implements FormBuilderInterface
{
    
    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger)  {
        parent::__construct($httpRequest, $httpResponse, $logger);
        
        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
        
        $this->entity = 'Staff';
        $this->tablename = 'staff';        
    }
    
  
    public function save($id) {
        
        $params = $this->httpRequest->getPost();
        $params['staff']['id'] = intval($id);
        $params['staff']['password'] = crypt($params['staff']['password']);
        unset($params['staff']['passwordConfirm']);
        
        $data = $this->dataSource->query(self::METHOD_POST, $this, 'saveStaff', $params['staff']);  
        
        $this->container->get('EventDispatcher')->dispatch(__YML_KEY, 'save_success', new Event('save_success', $data['Staff'][0]));
        $departments = $this->httpRequest->getAttribute('Departments');
        
        return array('Staff' =>$data['Staff'][0], 'Departments' => $departments, 'roles' => array());
    }
    
    
    public function listall($offset = 0, $rows = 20) {
       
        $params = array(
            //'directive::OFFSET' => $offset, 'directive::LIMIT' => $limit, 'directive::ORDER_BY' => 'Products.id asc'
            'directive::OFFSET' => $offset, 'directive::LIMIT' => $rows
        );
        $defaultLocale =  $this->getDefaultLocale();
        $params['locale'] = $defaultLocale['locale'];
        
        $data = $this->dataSource->query(self::METHOD_GET, $this, 'listStaff', $params);
        //$data['Staffs'] = current($data['Staffs']);
        $data['Departments'] = $this->formatArray($this->httpRequest->getAttribute('Departments'));
        
        if(is_array($data) && array_key_exists(ucfirst($this->tablename) . 'Count', $data)) {
            $data['pagination'] = $this->getPagination($data[ucfirst($this->tablename) . 'Count'], $offset, $rows);
        }
       
        return $data;
    }
    
    private function formatArray(array $result) {
        $retval = array();
        foreach($result as $row) {
            $retval[$row['id']] = $row['name'];
        }
        return $retval;
    }
    
    public function login() {
        //this is required for the login system - do not delete!
        


    }

    public function getFormWrapper() {
        return 'staff';
    }

}
