<?php

namespace components\events\listeners;

use core\eventlisteners\AbstractListener;
use components\events\models\EventModel;


/**
 * Description of LoadEventListener
 *
 * @author davem
 */
class LoadEventListener extends AbstractListener{
    
    public function on_request_start($params) {
        
        $datasource = $this->getDatasource('components\\events\\models\\EventModel');
        $model = new EventModel($this->httpRequest, $this->httpResponse, $this->logger);
        $params = $this->httpRequest->getParameters();
        
        $params = array('id' => $params[0]);
        
        $result = $datasource->query('get', $model, 'get', $params);
        if(array_key_exists('Event', $result)) {
            $this->httpRequest->setAttribute('Event', $result['Event']);
        } 
    }
}
