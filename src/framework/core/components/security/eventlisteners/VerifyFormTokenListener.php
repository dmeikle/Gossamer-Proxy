<?php

namespace core\components\security\eventlisteners;

use core\eventlisteners\AbstractListener;
use core\components\security\core\FormToken;


/**
 * Description of AuthorizationListener
 *
 * @author Dave Meikle
 */
class VerifyFormTokenListener extends BaseFormTokenListener{
    
    
    public function on_entry_point($params) {
        
        $token = $this->getToken();  
        if($token == false) {
            $this->eventDispatcher->dispatch('all', 'token_expired');
        }
        
        $this->checkTokenExists($token);   
        $defaultToken = $this->getDefaultToken();     
        
        $this->checkTokenValid($token, $defaultToken);
        $this->checkTokenDecayTime($token);
     
    }
    
    private function checkTokenExists($token) {
        if(is_null($token)) {
            $this->eventDispatcher->dispatch('all', 'token_missing');
        }
    }
    
    private function checkTokenDecayTime(FormToken $token) {
        $currentTime = time();
        $tokenTime = $token->getTimestamp();
        if(($currentTime - $tokenTime) > __MAX_DECAY_TIME) {
            
            $this->eventDispatcher->dispatch('all', 'token_expired');
        }                
    }
    
    private function checkTokenValid(FormToken $token, FormToken $defaultToken) {
       
        if(!crypt($token->getTokenString(), $defaultToken->toString() == $defaultToken->toString())) {
          
            $this->eventDispatcher->dispatch('all', 'token_missing');
        }
    }
    
    private function getToken() {
        $token = unserialize(getSession('_form_security_token'));
        
        return $token;
    }
}