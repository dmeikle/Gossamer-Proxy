<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */
namespace components\ticker\models;

use core\AbstractModel;
use components\ticker\lib\WebSocketClient;
use core\components\security\core\Client;

/**
 * TickerModel
 *
 * @author Dave Meikle
 */
class TickerModel extends AbstractModel {
    
    public function requestToken($staffId, $ipAddress) {        

        $webSocketClient = new WebSocketClient('192.168.2.252', 9000);
        $rawResponse = $webSocketClient->requestNewToken($staffId, $ipAddress);
        unset($webSocketClient);
        $responseArray = $this->parseResponse($rawResponse);
        $response = '';
        
        if(is_array($responseArray)) {
           return substr(current($responseArray),0, -2);
        }
        
        return null;        
    }

    private function parseResponse($rawToken) {
        $headers = array();
       
        $lines = preg_split("/\r\n/", $rawToken);
    
        foreach($lines as $line)
        {
            $line = chop($line);
            if(preg_match('/\A(\S+): (.*)\z/', $line, $matches))
            {               
                $headers[$matches[1]] = $matches[2];
            }
        }
        
        return $headers;
    }
}
