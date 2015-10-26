<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace libraries\utils\traits;

/**
 * GetLoggedInUser
 *
 * @author Dave Meikle
 */
trait GetLoggedInUser {

    /**
     *
     * @return int
     */
    protected function getLoggedInUser() {
        $token = $this->getSecurityToken();

        if (!is_object($token) || is_null($token->getClient())) {
            return null;
        }

        return $token->getClient();
    }

    /**
     *
     * @return SecurityToken
     */
    protected function getSecurityToken() {
        $serializedToken = getSession('_security_secured_area');
        $token = unserialize($serializedToken);

        return $token;
    }

}
