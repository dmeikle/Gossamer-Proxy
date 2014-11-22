<?php

namespace components\staff\listeners;

use core\eventlisteners\LoadItemListener;


/**
 * Description of LoadStaffListener
 *
 * @author davem
 */
class LoadStaffCredentialsListener extends LoadItemListener{
    
    protected function getParameters() {
      
        $params = $this->httpRequest->getParameters();
        
        return array('Staff_id' => $params[0]);
    }
}
