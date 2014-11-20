<?php

namespace core\components\security\eventlisteners;

use core\eventlisteners\AbstractListener;
use core\components\security\exceptions\TokenExpiredException;
use core\components\security\exceptions\TokenMissingException;

/**
 * Description of AuthorizationListener
 *
 * @author Dave Meikle
 */
class AuthorizationListener extends AbstractListener{    
    
    
    public function on_token_expired($params) {
        $this->logger->addError('Token expired on submitted form - throwing Exception');
        throw new TokenExpiredException();
    }
    
    public function on_token_missing($params) {
        $this->logger->addError('Token missing from submitted form - throwing Exception');
        throw new TokenMissingException();
    }
}
