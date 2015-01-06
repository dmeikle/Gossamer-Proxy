<?php

namespace components\contacts\listeners;

use core\eventlisteners\LoadItemListener;


/**
 * Description of LoadStaffListener
 *
 * @author davem
 */
class LoadLoggedInContactListener extends LoadItemListener{
    
    protected function getParameters() {
      
        $params = $this->httpRequest->getParameters();
        
        return array('id' => $this->getLoggedInStaffId());
    }
}
