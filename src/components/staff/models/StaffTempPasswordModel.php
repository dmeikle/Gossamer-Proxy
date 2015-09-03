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
use Gossamer\CMS\Forms\FormBuilderInterface;

class StaffTempPasswordModel extends AbstractModel implements FormBuilderInterface {

    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger) {
        parent::__construct($httpRequest, $httpResponse, $logger);

        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);

        $this->entity = 'StaffTempPassword';
        $this->tablename = 'stafftemppasswords';
    }

    public function createTempPassword(array $userAuthorization) {
        $params = array(
            'Staff_id' => $userAuthorization['Staff_id'],
            'password' => $this->randomPassword()
        );

        return $this->dataSource->query(self::METHOD_POST, $this, self::METHOD_SAVE, $params);
    }

    public function confirmReset(array $params) {
        
        return $this->dataSource->query(self::METHOD_GET, $this, 'ResetTempPassword', $params);        
    }
   
    public function getFormWrapper() {
        return $this->entity;  
    }

    private function randomPassword( $length = 8 ) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
        $password = substr( str_shuffle( $chars ), 0, $length );
        
        return $password;
    }
    
    public function confirmResetSubmit(array $staff) {
  
        $params = array(
            'password' => $this->encryptPassword($staff['StaffTempPassword']['password']),
            'uri' => $staff['uri']
        );       
        
        return $this->dataSource->query(self::METHOD_GET, $this, 'SaveResetTempPassword', $params);  
    }
    
    private function encryptPassword($password) {
        $newPwd = '';
        do {
            $newPwd = crypt($password);            
        }while(strpos($newPwd, '/'));
        echo $newPwd.'<br>';
        return $newPwd;
    }
}
