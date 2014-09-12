<?php

namespace core\components\security\handlers;

use core\eventlisteners\AbstractListener;

/**
 * Description of AuthorizationListener
 *
 * @author Dave Meikle
 */
class AuthorizationListener extends AbstractListener{
    
    
    public function on_security_check($params) {
        echo "on_security_check";
       pr($params);
       die;
    }
}
