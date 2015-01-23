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


/**
 * Description of LoadEventListener
 *
 * @author Dave Meikle
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
