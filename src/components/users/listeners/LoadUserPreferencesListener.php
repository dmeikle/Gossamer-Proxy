<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\users\listeners;

use core\eventlisteners\AbstractListener;
use core\eventlisteners\Event;
use libraries\utils\preferences\UserPreferences;
use libraries\utils\preferences\UserPreferencesManager;

/**
 * Description of LoadUserPreferencesListener
 *
 * @author Dave Meikle
 */
class LoadUserPreferencesListener extends AbstractListener{
    
    public function on_login_success(Event $event) {
        $modelName = $this->listenerConfig['class'];
        $eventParams = $event->getParams();
        $client = $eventParams['client'];
        $params = array('username' => $client->getCredentials());
        $model = new $modelName($this->httpRequest, $this->httpResponse, $this->logger);

        $datasource = $this->getDatasource($modelName);
        try{
            $result = $datasource->query('get', $model, 'get', $params);
            $userPreferences = new UserPreferences($result);
            
            $this->httpRequest->setAttribute('userPreferences', $userPreferences);
            $manager = new UserPreferencesManager($this->httpRequest);
            $manager->savePreferences($userPreferences->toArray());
         
        }catch(\Exception $e){}
    }
}
