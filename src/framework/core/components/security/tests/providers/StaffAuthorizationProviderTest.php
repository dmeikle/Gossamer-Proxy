<?php

namespace core\components\security\tests\providers;

use core\components\security\providers\StaffAuthorizationProvider;
use tests\BaseTest;
use core\components\security\core\Client;

/**
 * Description of StaffAuthorizationProviderTest
 *
 * @author davem
 */
class StaffAuthorizationProviderTest extends BaseTest{
    
    public function  __construct() {
        parent::__construct();   
        if(!defined('__YML_KEY')) {            
            define('__YML_KEY', 'admin_staff_list');    
        }
    }
    
    public function testLoadAccess() {  
        $sap = new StaffAuthorizationProvider();
        $config = $sap->loadAccess();
        //print_r($config);
    }
    
    public function testIsAuthorized() {   
        $sap = new StaffAuthorizationProvider();
        $sap->setClient($this->getClient());
        $this->assertTrue($sap->isAuthorized());
    }
    
    private function getClient() {
        $client = new Client();
        $client->setRoles(array('IS_STAFF', 'IS_ADMINISTRATOR'));
        
        return $client;
    }
}
