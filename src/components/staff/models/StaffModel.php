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

class StaffModel extends AbstractModel implements FormBuilderInterface {

    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger) {
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
        $queryParams = $this->httpRequest->getQueryParameters();
        
        $params = array(
            //'directive::OFFSET' => $offset, 'directive::LIMIT' => $limit, 'directive::ORDER_BY' => 'Products.id asc'
            'directive::OFFSET' => $offset, 'directive::LIMIT' => $rows
        );
        
        foreach($queryParams as $key => $value) {
            $params['directive::' . strtoupper($key)] = $value;
        }
        
        $defaultLocale = $this->getDefaultLocale();
        $params['locale'] = $defaultLocale['locale'];

        $data = $this->dataSource->query(self::METHOD_GET, $this, 'listStaff', $params);
        try{
            //$data['Staffs'] = current($data['Staffs']);
            $data['DepartmentsList'] = $this->formatArray($this->httpRequest->getAttribute('Departments'));
        }catch(\Exception $e) {}
        
        if (is_array($data) && array_key_exists(ucfirst($this->entity) . 'sCount', $data)) {
            $data['pagination'] = $this->getPagination($data[ucfirst($this->entity) . 'sCount'], $offset, $rows);
        }

        return $data;
    }

    private function formatArray(array $result = null) {
      if(is_null($result)) {
          return;
      }
        $retval = array();
        foreach ($result as $row) {
            if(count($row) < 1) {
                continue;
            }
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
    
    public function saveParams(array $params) {

        $data = $this->dataSource->query(self::METHOD_POST, $this, 'saveStaff', $params);

        return $data;
    }
    
    public function paginate($offset, $limit) {
        $params = array(
            'directive::OFFSET' => intval($offset),
            'directive::LIMIT' => intval($limit),
            'isActive' => '1'
        );
        
        $data = $this->dataSource->query(self::METHOD_GET, $this, 'count', $params); 
        
        return $data;   
    }
    
    public function search(array $params) {
        $offset = 0;
        $rows = 20;
        
        $params = array_merge($params, array(
            //'directive::OFFSET' => $offset, 'directive::LIMIT' => $limit, 'directive::ORDER_BY' => 'Products.id asc'
            'directive::OFFSET' => $offset, 'directive::LIMIT' => $rows
        ));
        $defaultLocale = $this->getDefaultLocale();
        $params['locale'] = $defaultLocale['locale'];

        $data = $this->dataSource->query(self::METHOD_GET, $this, 'search', $params);
     
        
        if (is_array($data) && array_key_exists(ucfirst($this->entity) . 'sCount', $data)) {
            $data['pagination'] = $this->getPagination($data[ucfirst($this->entity) . 'sCount'], $offset, $rows);
        }

        return $data;
    }
}
