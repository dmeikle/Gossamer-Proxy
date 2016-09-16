<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\components\security\eventlisteners;

use core\components\security\core\FormToken;

/**
 * generates a token to be embedded in each form that will be posted to
 * mitigate XSS attacks
 *
 * @author Dave Meikle
 */
class GenerateTokenOnAjaxPostListener extends GenerateFormTokenListener {

    /**
     * generates the token and embeds it at the bottom of the form
     *
     * @param Event $params
     */
    public function on_response_start(&$params) {
        /* AJAX check  */
        if (empty($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
            return;
        }

        $values = $params->getParams();

        $sessionToken = $this->getDefaultToken();
        $values['FORM_SECURITY_TOKEN'] = $sessionToken->generateTokenString();
        $params->setParams($values);

        $this->storeFormToken($sessionToken);
    }

    /**
     * saves the token into session so we can check in on POST
     *
     * @param FormToken $token
     */
    private function storeFormToken(FormToken $token) {

        setSession('_form_security_token', serialize($token));
    }

}
