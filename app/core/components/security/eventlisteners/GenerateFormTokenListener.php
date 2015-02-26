<?php

namespace core\components\security\eventlisteners;

use core\eventlisteners\AbstractListener;
use core\components\security\core\Client;
use core\components\security\core\FormToken;


/**
 * Description of AuthorizationListener
 *
 * @author Dave Meikle
 */
class GenerateFormTokenListener extends BaseFormTokenListener{
    
    
    public function on_response_end(&$params) {
       
       $values = $params->getParams();
    
       $sessionToken = $this->getDefaultToken();
       $token = $sessionToken->generateTokenString();
       
       $tokenString = "<input type=\"hidden\" name=\"FORM_SECURITY_TOKEN\" value=\"$token\" />";
       
       $content = $values['content'];
       $values['content'] = str_replace('</form>', "$tokenString\r\n</form>", $content);
       $params->setParams($values);
       
       $this->storeFormToken($sessionToken);
       
    }
    
    private function storeFormToken(FormToken $token) {
        setSession('_form_security_token', serialize($token));
    }
    
}