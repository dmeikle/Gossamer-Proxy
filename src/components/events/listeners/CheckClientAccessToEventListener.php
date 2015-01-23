<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\events\listeners;

use core\eventlisteners\AbstractListener;
use components\events\models\EventModel;
use core\system\Router;

/**
 * Check to see if the contact has been invited to this event 
 * before displaying it on screen for them.
 *
 * @author Dave Meikle
 */
class CheckClientAccessToEventListener extends AbstractListener{
    
    public function on_request_start($params) {
        $datasource = $this->getDatasource('components\\events\\models\\EventModel');
        $model = new EventModel($this->httpRequest, $this->httpResponse, $this->logger);
        $params = $this->httpRequest->getParameters();
        
        $params = array(
            'id' => $params[0],
            'Contacts_id' => $this->getLoggedInStaffId()
            );
        
        $result = $datasource->query('get', $model, 'checkContactAccess', $params);
        
        if(is_array($result) && array_key_exists('EventsCount', $result)) {
            $rowCount = $result['EventsCount'][0]['rowCount'];
           
            if($rowCount == 0) {
                $router = new Router($this->logger, $this->httpRequest);
                $router->redirect('portal_events_not_found', array(0));
            }
        }
        
    }
}
