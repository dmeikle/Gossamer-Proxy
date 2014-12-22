<?php

namespace components\contacts\listeners;

use core\eventlisteners\LoadItemListener;


/**
 * Description of LoadStaffListener
 *
 * @author davem
 */
class LoadLoggedInContactCredentialsListener extends LoadItemListener{
    
    protected function getParameters() {
      
        $params = $this->httpRequest->getParameters();
        
        return array('Contacts_id' => $this->getLoggedInStaffId());
    }
}
