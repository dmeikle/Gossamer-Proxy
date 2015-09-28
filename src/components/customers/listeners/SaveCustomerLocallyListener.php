<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\customers\listeners;

use core\eventlisteners\AbstractListener;
use core\eventlisteners\Event;

/**
 * Description of SaveStaffLocallyListener
 *
 * @author Dave Meikle
 */
class SaveCustomerLocallyListener extends AbstractListener{
    
    const MAX_PASSWORD_HISTORY = 6;
    
    public function on_save_success(Event $event) {
        $params = $event->getParams();
      
        $contactId = $params['Customers_id'];
       
        $datasource = $this->getDatasource('components\staff\models\CustomerAuthorizationModel');
        $query = sprintf('select * from CustomerAuthorizations where Customers_id = %d limit 1', $contactId);
        $Customer = array();
        $rowId = 'null';
        
        $rawResult = $datasource->execute($query);
        if(is_array($rawResult) && count($rawResult) > 0) {
            $Customer = current($rawResult);
            $rowId = $Customer['id'];
        }
       
        $this->setPasswordArray($Customer, $params);
        
        $query = "insert into CustomerAuthorizations (id, username, password, passwordHistory, status, Customers_id) values ( $rowId," 
                . "'" . $params['username'] . "','" . $params['password'] . "','" . $params['passwordHistory'] 
                . "','active','" . $params['Customers_id'] . "') on duplicate key update "
                . "username ='" . $params['username'] . "', password = '" . $params['password'] . "', passwordHistory = '"
                . $params['passwordHistory'] . "'";
    
       $datasource->execute($query);
      
    }

    private function setPasswordArray(array $Customer, &$postedCustomer) {
        
        if(count($Customer) < 1) {
            $postedCustomer['passwordHistory'] = $postedCustomer['password'];
            return ;
        }
        $passwords = explode('|', $Customer['passwordHistory']);
        $passwords[] = $postedCustomer['password'];
        if(count($passwords) > self::MAX_PASSWORD_HISTORY) {
            //remove the first element to make room for the new one
            array_shift($passwords);
        }
        
        $postedCustomer['passwordHistory'] = implode('|', $passwords);
    }    
             
}
