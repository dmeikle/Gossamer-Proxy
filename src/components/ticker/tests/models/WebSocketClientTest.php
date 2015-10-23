<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\ticker\tests\lib;

use components\ticker\lib\WebSocketClient;

/**
 * WebSocketClientTest
 *
 * @author Dave Meikle
 */
class WebSocketClientTest extends \tests\BaseTest {

    public function testRequestToken() {
        $client = new WebSocketClient('192.168.2.252', '9000');

        print_r($client->requestNewToken(2, '192.168.2.120'));
    }

}
