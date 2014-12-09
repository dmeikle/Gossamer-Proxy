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
      
        $params['Staff']['id'] = intval($id);
        
        $data = $this->dataSource->query(self::METHOD_POST, $this, 'saveStaff', $params['Staff']);  

        return $data;
    }
    
    
    public function listall($offset = 0, $rows = 20, $customVerb = NULL) {
       
        $params = array(
            //'directive::OFFSET' => $offset, 'directive::LIMIT' => $limit, 'directive::ORDER_BY' => 'Products.id asc'
            'directive::OFFSET' => $offset, 'directive::LIMIT' => $rows
        );
        $defaultLocale =  $this->getDefaultLocale();
        $params['locale'] = $defaultLocale['locale'];
        
        $data = $this->dataSource->query(self::METHOD_GET, $this, 'listStaff', $params);

        //$data['Staffs'] = current($data['Staffs']);
        $data['Departments'] = $this->formatArray($this->httpRequest->getAttribute('Departments'));
        
        if(is_array($data) && array_key_exists(ucfirst($this->entity) . 'sCount', $data)) {
            $data['pagination'] = $this->getPagination($data[ucfirst($this->entity) . 'sCount'], $offset, $rows);
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

        return $this->entity;

    }
    
    

}
