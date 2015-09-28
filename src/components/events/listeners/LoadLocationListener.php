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
use components\events\models\EventLocationModel;
use core\eventlisteners\Event;


/**
 * Description of LoadEventListener
 *
 * @author Dave Meikle
 */
class LoadLocationListener extends AbstractListener{
    
    public function on_event_loaded(Event $event) {
        
        $datasource = $this->getDatasource('components\\events\\models\\EventLocationModel');
        $model = new EventLocationModel($this->httpRequest, $this->httpResponse, $this->logger);
        $params = $event->getParams();
       
        $result = $datasource->query('get', $model, 'get', array('id' => $params['EventLocations_id']));
        if(array_key_exists('EventLocation', $result)) {
            $this->httpRequest->setAttribute('EventLocation', $result['EventLocation']);
        } 
        
    }
}
