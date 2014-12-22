<?php

namespace components\contacts\listeners;

use core\eventlisteners\LoadItemListener;


/**
 * Description of LoadStaffListener
 *
 * @author davem
 */
class LoadContactCredentialsListener extends LoadItemListener{
    
    protected function getParameters() {
      
        $params = $this->httpRequest->getParameters();
        
        return array('Contacts_id' => $params[0]);
    }
}
