<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace extensions\oauth\controllers;

use core\AbstractController;
use Bramus\Router\Router;

/**
 * OAuthController
 *
 * @author Dave Meikle
 */
class OAuthController extends AbstractController {

    public function validate() {
        // Create Router instance
        $router = new Router();

        // Check JWT on /secured routes. This can be any route you like
        $router->before('GET', '/secured/.*', function() {

            // This method will exist if you're using apache
            // If you're not, please go to the extras for a defintion of it.
            //        $requestHeaders = apache_request_headers();
            //        $authorizationHeader = $requestHeaders['Authorization'];


            $authorizationHeader = $this->httpRequest->getHeader('Authorization');

            if ($authorizationHeader == null) {
                header('HTTP/1.0 401 Unauthorized');
                echo "No authorization header sent";
                exit();
            }

            // // validate the token
            $token = str_replace('Bearer ', '', $authorizationHeader);
            $secret = 'tx6r7vVEQlrhE3fJ5OR7bv6SZEHHU7vorUW4h8jH8l1E_Th5YCn11bVgLmqlf_-e';
            $client_id = 'Tb0KiL0uGWxrktOJ4bPNyzn8YMi52T4t';
            $decoded_token = null;

            try {
                $decoded_token = \Auth0\SDK\Auth0JWT::decode($token, $client_id, $secret);
            } catch (\Auth0\SDK\Exception\CoreException $e) {
                header('HTTP/1.0 401 Unauthorized');
                echo "Invalid token";
                exit();
            }
        });
    }

}
