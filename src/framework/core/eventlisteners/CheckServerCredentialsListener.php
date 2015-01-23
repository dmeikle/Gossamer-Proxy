<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\eventlisteners;

use filters\FilterChain;
use libraries\utils\Registry;
use exceptions\InvalidServerIDException;
use exceptions\UnauthorizedAccessException;
use entities\ServerAuthenticationToken;
use commands\GetCommand;

class CheckServerCredentialsListener extends AbstractListener
{ 
    
    public function on_entry_point($params) {
        if (is_null($params['Headers']['serverAuth']) || strlen($params['Headers']['serverAuth'] < 1)) {
            $this->logger->addError('CheckServerCredentialsListener::on_entry_point expects serverAuth header');
            throw new InvalidServerIDException('server identification missing from Headers');
        }
        if(!$this->checkServer($params['Headers']['serverAuth'], $params['httpRequest']->getAttribute('ipAddress'))) {
            $this->logger->addError('CheckServerCredentialsListener::on_entry_point has mismatched serverAuth header using ' . $params['httpRequest']->getAttribute('ipAddress'));
            throw new UnauthorizedAccessException($params['httpRequest']->getAttribute('ipAddress') . ' is not authorized');
        }
    }


    private function checkServer($authToken, $ipAddress){

        $token = new ServerAuthenticationToken();
        $cmd = new GetCommand($token, $this->registry);
        $result = $cmd->execute(array('token' => $authToken, 'ipAddress' =>$ipAddress), null);

        if(is_null($result) || count($result) == 0){
            throw new UnauthorizedAccessException("Server not found", 1);
        }

        //check to see if the token is expired - only used if we have a licensing agreement that expires
        // if($result['expirationTime'] < time()) {
            // throw new UnauthorizedAccessException();
        // }

        return ($result['id'] > 0);

    }
}
