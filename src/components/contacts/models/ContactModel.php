<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

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
    
    public function listall($offset = 0, $rows = 20, $customVerb = null, array $params = null) {

        $queryParams = $this->httpRequest->getQueryParameters();
        
        $params = array();
        
        foreach($queryParams as $key => $value) {
            //$params['directive::' . strtoupper($key)] = $value; //commented out to fix advanced search
            $params[$key] = $value;
        }
        
        $defaultLocale = $this->getDefaultLocale();
        $params['locale'] = $defaultLocale['locale'];
        
        return parent::listall($offset, $rows, 'listContacts', $params);

    }
    
    public function save($id) {
        
        $params = $this->httpRequest->getPost();
        $params['Contact']['id'] = intval($id);
        
        $data = $this->dataSource->query(self::METHOD_POST, $this, 'saveContact', $params['Contact']);  
                
        return array('Contact' =>$data['Contact'][0], 'roles' => array());
    }
    
    
    public function edit($id) {
       
        $params = array('id' => $id);
      
        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_GET, $params);
                
        return $data;
    }
    
    
    public function view() {
       
        $params = array('id' => $this->getLoggedInStaffId());
      
        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_GET, $params);
        
        if(is_array($data) && array_key_exists('Contact', $data)) {
            $data['Contact'] = current($data['Contact']);
        }
        return $data;
        
    }

    public function getFormWrapper() {
        return $this->entity;
    }

    public function findByEmail($email) {
        $params = array('email' => $email);
      
        return $this->dataSource->query(self::METHOD_GET, $this, self::VERB_GET, $params);
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
