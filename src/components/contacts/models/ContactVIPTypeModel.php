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
use Gossamer\CMS\Forms\FormBuilderInterface;

class ContactVIPTypeModel extends  AbstractModel implements FormBuilderInterface
{
    
    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger)  {
        parent::__construct($httpRequest, $httpResponse, $logger);
        
        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
        
        $this->entity = 'ContactVIPType';
        $this->tablename = 'contactviptypes';        
    }
    
    public function login() {
       
    }
    
    public function listall($offset = 0, $rows = 20, $customVerb = null, array $params = null) {
        return parent::listall($offset, $rows, 'listContacts');
    }
    
    public function save($id) {
        
        $params = $this->httpRequest->getPost();
        $params['Contact']['id'] = intval($id);
        
        return $this->dataSource->query(self::METHOD_POST, $this, 'saveContact', $params[$this->entity]);  
               
    }
    
    
    public function edit($id) {
       
        $params = array('id' => $id);
      
        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_GET, $params);
        if(is_array($data) && array_key_exists('Contact', $data)) {
            $data['Contact'] = current($data['Contact']);
        } else {
            $data['Contact'] = array();
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
}
