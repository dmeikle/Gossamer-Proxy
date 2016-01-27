<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\messaging\listeners;

use core\eventlisteners\AbstractListener;
use extensions\websockets\lib\WebsocketClient;

/**
 * GenerateMessagingTokenListener
 *
 * @author Dave Meikle
 */
class GenerateMessagingTokenListener extends AbstractListener {

    public function on_request_start($params) {
        $client = null;
        echo "\r\n<!-- \r\n";
        try {
            $client = new WebsocketClient('72.4.146.149', '9000');
        } catch (\Exception $e) {

        }

        echo " -->\r\n";
        $data = array(
            'serverAuthToken' => '123',
            'method' => 'request_new_token',
            'clientIp' => $_SERVER['REMOTE_ADDR'],
            'name' => 'Dave'
        );

        $response = $client->sendData($data);
        $message = $response['message'];
        $tmp = explode(': ', $message);
        $token = $tmp[1];
        $this->httpResponse->setAttribute('MESSAGING_TOKEN', $token);
    }

}
