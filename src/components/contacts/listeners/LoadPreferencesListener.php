<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\contacts\listeners;

use core\eventlisteners\AbstractListener;
use core\eventlisteners\Event;
use components\contacts\models\ContactPreferenceModel;
use libraries\utils\preferences\UserPreferencesManager;

/**
 * Description of LoadPreferencesListener
 *
 * @author Dave Meikle
 */
class LoadPreferencesListener extends AbstractListener{
    
    
    public function on_login_success(Event &$event) {
        $params = $event->getParams();
        
        $retval = array();
        $model = new ContactPreferenceModel($this->httpRequest, $this->httpResponse, $this->logger);

        $params = array('Contacts_id'=> $params['client']->getId());

        $datasource = $this->getDatasource('components\contacts\models\ContactPreferenceModel');

        $result = $datasource->query('get', $model, 'get', $params);
        
        if(array_key_exists('ContactPreference', $result)) {
            $preference = current($result['ContactPreference']);
            unset($preference['Contacts_id']);
            unset($preference['id']);
           
            $manager = new UserPreferencesManager($this->httpRequest);
            $manager->savePreferences($preference);
            unset($manager);
        }
    }
    
}
