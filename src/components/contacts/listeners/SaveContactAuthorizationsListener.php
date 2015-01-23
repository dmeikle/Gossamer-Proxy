<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\contacts\listeners;

use core\eventlisteners\AbstractListener;
use core\eventlisteners\Event;


/**
 * Description of SaveUserAuthorizationsListener
 *
 * @author Dave Meikle
 */
class SaveContactAuthorizationsListener extends AbstractListener{
    
    public function on_save_success(Event $event) {
        $params = $event->getParams();
        $datasource = $this->getDatasource('components\contacts\models\ContactAuthorizationModel');
        $contactId = $params['userAuthorizations']['id'];
        
        $result = $datasource->query(sprintf("update ContactAuthorizations set roles = '" . $this->buildArray($params['userAuthorizations']) .
           "' where Contacts_id = %d", $contactId));
      
    }
        
    private function buildArray(array $authorizations) {
        unset($authorizations['id']);
        $retval = '';
          
        foreach($authorizations as $key => $value) {            
            $retval .= "|$key";
        }
        
        return substr($retval,1);
    }
}
